Ext.define('ExtMVC.controller.Fiscalyears', {
    extend: 'Ext.app.Controller',

    stores: ['Fiscalyears'],

    models: ['Fiscalyear'],

    views: ['fiscalyear.Formulario', 'fiscalyear.Grid'],

    init: function() {
        this.control({
            'fiscalyeargrid dataview': {
                itemdblclick: this.editar 
            },
            'fiscalyeargrid': {
                afterrender: this.loadAtInit 
            },
            '#fiscalyearlist': {
                itemcontextmenu : this.contextMenuBox
            },
            'fiscalyeargrid button[action=add]': {
                click: this.editar
            },
            'fiscalyeargrid button[action=delete]': {
                click: this.deleter              
            },
            'fiscalyeargrid button[action=search]': {
                click: this.search
            },
            'fiscalyeargrid textfield[itemId=fiscalyear]': {
                change: this.search
            },
            'fiscalyeargrid combo[itemId=status]': {
                change: this.search
            },
            'fiscalyearform button[action=save]': {
                click: this.update
            },
            'fiscalyeargrid button[action=print]': {
                click: this.print
            }
        });
    },
    loadAtInit:function(view){
        var l = new MyLib();
        l.adjustGrid(view);
    },
    contextMenuBox:function( view, record, item, index,  e, eOpts ){
        var menu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Edit',
                iconCls:'icon-edit',
                handler :function   () {
                    var edit = new ExtMVC.view.fiscalyear.Formulario({modal:true});
                    edit.show(); 
                    
                    if(record){
                        edit.down('form').loadRecord(record);
                    }  
                    edit.down('form').query('#fiscalyear')[0].focus(false,200); 
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
    
    editar: function(grid, record) {
        var edit = new ExtMVC.view.fiscalyear.Formulario({modal:true});
        edit.show(); 
        
        if(record){
            edit.down('form').loadRecord(record);
        }  
        edit.down('form').query('#fiscalyear')[0].focus(false,200);       
    },
    
    
    update: function(button) {
        
        var win = button.up('window'),
            form   = win.down('form'),
            record = form.getRecord(),
            values = form.getValues();
            
        var novo = false;
        if (values.id > 0){
            record.set(values);
        } else{
            record = Ext.create('ExtMVC.model.Fiscalyear');
            record.set(values);
            this.getFiscalyearsStore().add(record);
            novo = true;
        }
        
        win.close();
        this.getFiscalyearsStore().sync();
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
                    var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                    var w = parent.getActiveTab();
                    
                    var grid = w.down('grid'),
                    record = grid.getSelectionModel().getSelection(), 
                    store = grid.store;
                    
                    store.remove(record);
                    grid.store.sync();
                }
            },
            icon : Ext.Msg.QUESTION
        },button );
    },

    search: function(button) {
        var f= button.up('form');
        var fiscalyear = f.query('#fiscalyear')[0].getValue();
        var chkStatus = f.query('#status')[0].getValue();
        
        Ext.Ajax.request({
                waitMsg: 'Searching...', 
                method: 'POST',
                url: 'api/fiscalyear/search.php',
                params: {
                        start:0,
                        limit:99999999999, 
                        fiscalyear: fiscalyear,
                        status: chkStatus
                },
                scope:this,
                success: function(response){
                    var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                    var w = parent.getActiveTab();
                    var grd = w.down('grid');
                    var gData = Ext.JSON.decode(response.responseText);        
                    grd.getStore().loadData(gData.fiscalyears);
                        
                },
                failure: this.onSearchFailure
                
        }, button);
           
    },

   
    onSearchFailure: function(err){
            Ext.MessageBox.alert('Status', 'Error occured during searching...');
    },
    print    :function   (button ){
        var lib = new MyLib ();
        var tb = Ext.ComponentQuery.query('#contentPanel')[0];
        var w = tb.getActiveTab();
        var g = w.down('grid');

         var reportHd ="</br>";


        var reportName="App app_setting List";
        var reportHeader = lib.getReportHeader(reportName);
        
        var tbl = lib.gridToHtml(g,36, reportHeader, reportHd,"+");
        lib.printReport(tbl);
    }
});