Ext.define('ExtMVC.view.app_setting.app_settinggrd' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.appgrid',
    itemId:'appgrid',
   	requires:['ExtMVC.store.Appsettings'],
    title: 'App Setting',
    modal:true,
    width:400,
    items:[{
    	xtype:'form',
        title: Ext.lang.global.searchTitle[Ext.lang.global.langId],
        iconCls:'icon-grid',
        bodyPadding:5,
    	layout:{
    		type:'hbox',
    		align:'stretch'
    	},
    	items:[{
    		xtype:'textfield',
    		fieldLabel:'Setting Name',
    		itemId:'setting_name',
    		name:'setting_name',
    		labelWidth:110,
    		flex:1
    	},{
    		xtype:'button',
    		text:Ext.lang.global.search[Ext.lang.global.langId],
    		action:'search',
    		iconCls:'icon-search',
    		itemId:'btnSearch',
    		name:'btnSearch'
    	}]
    },{
    	xtype: 'toolbar',
        items: [{
            iconCls: 'icon-add',
            text: Ext.lang.global.add[Ext.lang.global.langId],
            action: 'add'
        },{
            iconCls: 'icon-print',
            text: Ext.lang.global.print[Ext.lang.global.langId],
            action: 'print'
        },{
            iconCls: 'icon-close',
            text: Ext.lang.global.close[Ext.lang.global.langId],
            action:'close',
            handler:function(buttons,e){
                var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                var w = parent.getActiveTab();
                w.close();
            }
        }]
    },{
    	xtype:'grid',
    	height:250,
    	store:'Appsettings',
    	columns:[{
    		header:'Setting Name',
    		dataIndex:'setting_name',
    		flex:5
    	},{
    		header:'Value Text',
    		dataIndex:'value_txt',
    		flex:2
    	}]
    }]
})