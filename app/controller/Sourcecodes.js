Ext.define('ExtMVC.controller.Sourcecodes', {
    extend: 'Ext.app.Controller',

    stores: ['Sourcecodes'],

    models: ['Sourcecode'],

    views: ['sourcecode.Formulario', 'sourcecode.Grid'],
    
    init: function() {
        this.control({
            'sourcecodegrid': {
                beforerender:this.loadAtInit
            },
            'sourcecodegrid grid': {
                itemcontextmenu : this.contextMenuBox
            },
            'sourcecodegrid dataview': {
                itemdblclick: this.editar 
            },
            'sourcecodegrid button[action=add]': {
                click: this.editar
            },
            'sourcecodegrid button[action=delete]': {
                click: this.deleter              
            },
            'sourcecodegrid button[action=search]': {
                click: this.search
            },
            'sourcecodegrid button[action=print]': {
                click: this.print
            },
            'sourcecodegrid textfield[itemId=sourceCode]': {
                change: this.search
            },
            'sourcecodegrid combo[itemId=status]': {
                change: this.search
            },
            'sourcecodeform button[action=save]': {
                click: this.update
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
                    var edit = new ExtMVC.view.sourcecode.Formulario({modal:true});
                    edit.show(); 
                    
                    if(record){
                        edit.down('form').loadRecord(record);
                    }  
                    edit.down('form').query('#sourceCode')[0].focus(false,200); 
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


        var reportName="Source Code List";
        var reportHeader = lib.getReportHeader(reportName);
        
        var tbl = lib.gridToHtml(g,36, reportHeader, reportHd,'+');
        lib.printReport(tbl);
    },
    
    editar: function(grid, record) {
        var edit = new ExtMVC.view.sourcecode.Formulario({modal:true});
        edit.show(); 
        
        if(record){
            edit.down('form').loadRecord(record);
        } 
        edit.down('form').query('#sourceCode')[0].focus(false,200);
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
            record = Ext.create('ExtMVC.model.Sourcecode');
			record.set(values);
			this.getSourcecodesStore().add(record);
            novo = true;
		}
        
		this.getSourcecodesStore().sync();
        win.close();
        
        
        var w = Ext.ComponentQuery.query('#sourcecodegrid')[0];
        w.down('toolbar').items.items[0].focus(false,200);
       
    },
    
    
    search: function(button) {
        var f= button.up('form');
        var sourceCode = f.query('#sourceCode')[0].getValue();
        var chkStatus = f.query('#status')[0].getValue();
        
		Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            async:false,
            url: 'api/Sourcecode/search.php',
            params: {
                    start:0,
                    limit:99999999999, 
                    sourceCode: sourceCode,
                    status: chkStatus
            },
            scope:this,
            success: function(response){
                var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                var w = parent.getActiveTab();
                var grd =  w.down('grid');
                var gData = Ext.JSON.decode(response.responseText);   
                grd.getStore().loadData(gData.sourcecodes);
                    
            },
            failure: this.onSearchFailure
            
        });       
    },

    
    onSearchFailure: function(err){
            Ext.MessageBox.alert('Status', 'Error occured during searching...');
    }  
});