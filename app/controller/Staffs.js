Ext.define('ExtMVC.controller.Staffs', {
    extend: 'Ext.app.Controller',

    stores: ['Staffs'],

    models: ['Staff'],

    views: ['Staff.StaffForm', 'Staff.StaffGrid'],

    init: function() {
        //debugger;
        this.control({
            'staffgrid dataview': {
                itemdblclick: this.editar
            },
            '#staffgrid grid': {
                itemcontextmenu : this.contextMenuBox
            },
            'staffgrid button[action=add]': {
                click: this.editar
            },
            'staffgrid button[action=delete]': {
                click: this.deleter               
            },
            'staffgrid button[action=search]': {
                click: this.search
            },
            'staffgrid button[action=print]': {
                click: this.print
            },
            'staffgrid textfield[itemId=staffName]': {
                change: this.search
            },
            'staffgrid combo[itemId=designationId]': {
                change: this.search
            },
            'staffgrid combo[itemId=status]': {
                change: this.search
            },
            'staffform button[action=save]': {
                click: this.update
            },
            'staffgrid actioncolumn#myAction': {
                click: function(grid,cell,row,col,e){
                    var record = grid.getStore().getAt(row);
                    var action = e.target.getAttribute('class');
                    if(action.indexOf("x-action-col-0") != -1){
                        var edit = new ExtMVC.view.Staff.StaffForm({modal:true});
                        edit.show(); 
                        
                        if(record){
                            edit.down('form').loadRecord(record);
                        } 
                    }else if(action.indexOf("x-action-col-1") != -1){
                        Ext.Msg.show({
                            title : Ext.lang.global.appname,
                            msg : Ext.lang.msg.deleteRecord[Ext.lang.global.langId],
                            width : 300,
                            closable : false,
                            buttons : Ext.Msg.YESNO,
                            buttonText : 
                            {
                                yes : Ext.lang.global.yes[Ext.lang.global.langId],
                                no : Ext.lang.global.no[Ext.lang.global.langId]
                            },
                            multiline : false,
                            fn : function(buttonValue, inputText, showConfig){
                                if(buttonValue=="yes"){
                                    
                                    var l = new MyLib();
                                    l.deleteRecord('staff', record.data.id);
                                    grid.up('window').down('form').query('#btnSearch')[0].fireHandler(); 
                                }
                            },
                            icon : Ext.Msg.QUESTION
                        });
                    }
                }
            }
        });
    },
    contextMenuBox:function( view, record, item, index,  e, eOpts ){
        var menu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Edit',
                iconCls:'icon-edit',
                handler :function   () {
                    var edit = new ExtMVC.view.Staff.StaffForm({modal:true});
                    edit.show(); 
                    
                    if(record){
                        edit.down('form').loadRecord(record);
                    }   
                    edit.down('form').query('#staffform')[0].focus(false,200); 
                }
            },{
                text: 'Delete',
                iconCls:'icon-delete',
                handler :function   () {
                    Ext.Msg.show({
                        title : Ext.lang.global.appname,
                        msg : Ext.lang.msg.deleteRecord[Ext.lang.global.langId],
                        width : 300,
                        closable : false,
                        buttons : Ext.Msg.YESNO,
                        buttonText : 
                        {
                            yes : Ext.lang.global.yes[Ext.lang.global.langId],
                            no : Ext.lang.global.no[Ext.lang.global.langId]
                        },
                        multiline : false,
                        fn : function(buttonValue, inputText, showConfig){
                            if(buttonValue=="yes"){   
                                var l = new MyLib();
                                var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                                var w = parent.getActiveTab();
                                var grid = w.down('grid'),
                                store = grid.store;
                                
                                store.remove(record);
                                grid.store.sync();
                                l.showMessage(Ext.lang.global.recordDeleted[Ext.lang.global.langId], Ext.Msg.INFO);
                            }
                        },
                        icon : Ext.Msg.QUESTION
                    });
                } 
            }]
        });
    
        e.stopEvent();
        menu.showAt(e.getXY());
    },
    
    print    :function   (button ){
        var lib = new MyLib ();
        var parent = Ext.ComponentQuery.query('#contentPanel')[0];
        var w = parent.getActiveTab();
        var g = w.down('grid');

         var reportHd ="</br>";


        var reportName="Staff List";
        var reportHeader = lib.getReportHeader(reportName);
        
        var tbl = lib.gridToHtml(g,36, reportHeader, reportHd,"+");
        lib.printReport(tbl);
    },
    editar: function(grid, record) {
        var edit = new ExtMVC.view.Staff.StaffForm({modal:true});
        edit.show(); 
        
        if(record){
            edit.down('form').loadRecord(record);
        } 
    },
    
    
    update: function(button) {
        
        var win    = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
            
        var novo = false;
        if (values.id > 0){
            record.set(values);
        } else{
                record = Ext.create('ExtMVC.model.Staff');
                record.set(values);
                this.getStaffsStore().add(record);
                novo = true;
        }
            
        win.close();
        this.getStaffsStore().sync();

        if (novo){ //faz reload para atualziar
            click: this.search
        }        
    },
    
    deleter: function(button) {        
        Ext.Msg.show({
            title : Ext.lang.global.appname,
            msg : Ext.lang.msg.deleteRecord[Ext.lang.global.langId],
            width : 300,
            closable : false,
            buttons : Ext.Msg.YESNO,
            buttonText : 
            {
                yes : Ext.lang.global.yes[Ext.lang.global.langId],
                no : Ext.lang.global.no[Ext.lang.global.langId]
            },
            multiline : false,
            fn : function(buttonValue, inputText, showConfig){
                if(buttonValue=="yes"){
                    
                    var w = button.up('window');
                    var grid = w.down('grid'),
                    record = grid.getSelectionModel().getSelection(), 
                    store = grid.store;                    
                    store.remove(record);
                    grid.store.sync();
                    click: this.search
                }
            },
            icon : Ext.Msg.QUESTION
        },button );
    },

    search: function(button) {
        var f= button.up('form');
        var staffName = f.query('#staffName')[0].getValue();
        var chkStatus = f.query('#status')[0].getValue();
        var designationId=f.query('#designationId')[0].getValue();
        
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            url: 'api/Staff/search.php',
            params: {
                    start:0,
                    limit:15, 
                    staffName: staffName,
                    status: chkStatus,
                    designationId:designationId
            },
            scope:this,
            success: function(response){
                var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                var w = parent.getActiveTab();
                var grd =  w.down('grid');
                var gData = Ext.JSON.decode(response.responseText);        
                grd.getStore().loadData(gData.staffs);
                    
            },
            failure: this.onSearchFailure
                
        },button);
           
    },

    
    onSearchFailure: function(err){
            Ext.MessageBox.alert('Status', 'Error occured during searching...');
    }  
});