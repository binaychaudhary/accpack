Ext.define('ExtMVC.controller.Appsettings', {
    extend: 'Ext.app.Controller',

    stores: ['Appsettings'],

    models: ['appsetting'],

    views: ['app_setting.appsettingform', 'app_setting.app_settinggrd'],

    init: function() {
        //debugger;
        this.control({
            'appgrid': {
                afterrender:this.loadAtInit
            },
            'appgrid grid': {
                itemcontextmenu : this.contextMenuBox
            },
            'appgrid dataview': {
                itemdblclick: this.editar
            },
            'appgrid button[action=add]': {
                click: this.editar
            },
            'appgrid button[action=delete]': {
                click: this.deleter               
            },
            'appgrid button[action=search]': {
                click: this.search
            },
            'appgrid button[action=print]': {
                click: this.print
            },
            'appgrid textfield[itemId=setting_name]': {
                change: this.search
            },
            
            'appsettingform button[action=save]': {
                click: this.update
            },
            'appgrid actioncolumn#myAction': {
                click: function(grid,cell,row,col,e){
                    var record = grid.getStore().getAt(row);
                    var action = e.target.getAttribute('class');
                    if(action.indexOf("x-action-col-0") != -1){
                        var edit = new ExtMVC.view.app_setting.appsettingform({modal:true});
                        edit.show(); 
                        
                        if(record){
                            edit.down('form').loadRecord(record);
                        } 
                    }else if(action.indexOf("x-action-col-1") != -1){
                        Ext.Msg.show({
                            title : Ext.lang.global.appname,
                            msg : Ext.lang.msg.deleteRecord,
                            width : 300,
                            closable : false,
                            buttons : Ext.Msg.YESNO,
                            buttonText : 
                            {
                                yes : Ext.lang.global.yes,
                                no : Ext.lang.global.no
                            },
                            multiline : false,
                            fn : function(buttonValue, inputText, showConfig){
                                if(buttonValue=="yes"){
                                    
                                    var l = new MyLib();
                                    l.deleteRecord('app_setting', record.data.id);
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
    loadAtInit:function(view){
        var l = new MyLib();
        l.adjustGrid(view);

        var f = view.down('form');
        var btnSearch= f.query('#btnSearch')[0];
        btnSearch.fireHandler();
    },
    contextMenuBox:function( view, record, item, index,  e, eOpts ){

        var menu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Edit',
                iconCls:'icon-edit',
                handler :function   () {
                    var edit = new ExtMVC.view.app_setting.appsettingform({modal:true});
                    edit.show(); 
                    
                    if(record){
                        edit.down('form').loadRecord(record);
                    } 
                    edit.down('form').query('#setting_name')[0].focus(false,200);
                }
            },{
                text: 'Delete',
                iconCls:'icon-delete',
                handler :function   () {
                    Ext.Msg.show({
                        title : Ext.lang.global.appname,
                        msg : Ext.lang.msg.deleteRecord,
                        width : 300,
                        closable : false,
                        buttons : Ext.Msg.YESNO,
                        buttonText : 
                        {
                            yes : Ext.lang.global.yes,
                            no : Ext.lang.global.no
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
        var tb = Ext.ComponentQuery.query('#contentPanel')[0];
        var w = tb.getActiveTab();
        var g = w.down('grid');

         var reportHd ="</br>";


        var reportName="App app_setting List";
        var reportHeader = lib.getReportHeader(reportName);
        
        var tbl = lib.gridToHtml(g,36, reportHeader, reportHd,"+");
        lib.printReport(tbl);
    },
    editar: function(grid, record) {
        var edit = new ExtMVC.view.app_setting.appsettingform({modal:true});
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
                record = Ext.create('ExtMVC.model.appsetting');
                record.set(values);
                this.getAppsettingsStore().add(record);
                novo = true;
        }            
        win.close();
        this.getAppsettingsStore().sync();
    },
    
   

    search: function(button) {
        var f= button.up('form');
        var setting_name = f.query('#setting_name')[0].getValue();
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            url: 'api/appsetting/list.php',
            params: {
                    setting_name: setting_name
            },
            scope:this,
            success: function(response){
                var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                var w = parent.getActiveTab();
                var grd =  w.down('grid');
                var gData = Ext.JSON.decode(response.responseText);        
                grd.getStore().loadData(gData.appsettings);
                    
            },
            failure: this.onSearchFailure                
        });           
    },
    
    onSearchFailure: function(err){
        Ext.MessageBox.alert('Status', 'Error occured during searching...');
    }  
});