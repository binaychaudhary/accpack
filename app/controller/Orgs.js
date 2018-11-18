Ext.define('ExtMVC.controller.Orgs', {
    extend: 'Ext.app.Controller',

    stores: ['Orgs'],

    models: ['Org'],

    views: ['Org.Orggrid', 'Org.Orgform'],
    
    init: function() {
        this.control({
            'orggrid': {
                afterrender:this.loadAtInit
            },
            'orggrid grid': {
                itemcontextmenu : this.contextMenuBox
            },
            'orggrid dataview': {
                itemdblclick: this.editar 
            },            
            'orggrid button[action=add]': {
                click: this.editar
            },
            'orggrid button[action=delete]': {
                click: this.deleter              
            },
            'orggrid button[action=print]': {
                click: this.print              
            },
            'orgform button[action=save]': {
                click: this.update
            }            
        });
    },
    loadAtInit:function(view){
        var l = new MyLib();
        l.adjustGridWF(view);
    },
    contextMenuBox:function( view, record, item, index,  e, eOpts ){

        var menu = Ext.create('Ext.menu.Menu', {
            items: [{
                text: 'Edit',
                iconCls:'icon-edit',
                handler :function   () {
                    var edit = new ExtMVC.view.Org.Orgform({modal:true});
                    edit.show(); 
                    
                    if(record){
                        edit.down('form').loadRecord(record);
                    } 
                    edit.down('form').query('#orgName')[0].focus(false,200);
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

        var f = w.down('form');
        var reportHd ="</br>";

        var reportName="Organization List";
        var reportHeader = lib.getReportHeader(reportName);
        //var reportFooter = lib.getReportFooter();
      
        var tbl = lib.gridToHtml(g);

        var preport  =  reportHeader + reportHd + tbl;// + reportFooter;
        lib.printReport(preport);
    },
    editar: function(grid, record) {
        var edit = new ExtMVC.view.Org.Orgform({modal:true});
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
            record = Ext.create('ExtMVC.model.Org');
			record.set(values);
			this.getOrgsStore().add(record);
            novo = true;
		}
        
		win.close();
        this.getOrgsStore().sync();
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
                    var grid = w.down('grid');
                    record = grid.getSelectionModel().getSelection(), 
                    store = grid.store;
                    
                    store.remove(record);
                    grid.store.sync();
                }
            },
            icon : Ext.Msg.QUESTION
        });     
    }
});