Ext.define('ExtMVC.view.sourcecode.Grid' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.sourcecodegrid',
    itemId:'sourcecodegrid',
    requires: [
        'Ext.toolbar.Paging','ExtMVC.utility.StatusChecked',
        'ExtMVC.store.general.StatusStore'
    ],
    width:600,
    iconCls:'icon-source-code',
    title:Ext.lang.mainmenu.master.sourcecode.formDesc[Ext.lang.global.langId],
    items:[{
        xtype: 'form',
        itemId:'form',
        layout:{
            type:'vbox',
            align:'stretch'
        },

        items:[{
            xtype:'container',
            width:'100%',
            padding: 10,
            border: false,
            dock: 'top',
            collapsible: true,
            title: Ext.lang.mainmenu.master.sourcecode.formDesc[Ext.lang.global.langId],
            iconCls: 'icon-grid',
            layout: {
                type: 'hbox',
                align: 'fit'
            },
            items: [
                {
                    xtype: 'textfield',
                    itemId: 'sourceCode',
                    name: 'sourceCode',
                    padding: '0 20 0 0',
                    fieldLabel: Ext.lang.mainmenu.master.sourcecode.sourcecode[Ext.lang.global.langId],
                    flex:5
                },{
                    xtype:'combo',
                    fieldLabel:Ext.lang.global.status[Ext.lang.global.langId],
                    labelWidth:55,
                    name:'status',
                    itemId:'status',
                    queryMode:'local',
                    margin: '0 10 0 0',
                    store:{
                        type:'statusStore'
                    },
                    displayField:'name',
                    valueField:'value',
                    flex:3
                    
                },{
                    xtype: 'button',
                    itemId: 'btnSearch',
                    iconCls:'icon-search',
                    text: Ext.lang.global.search[Ext.lang.global.langId],
                    action:'search',
                    hidden:true
                }
            ]
        },{
            xtype: 'toolbar',
            items: [{
                iconCls: 'icon-add',
                itemId: 'add',
                text: Ext.lang.global.add[Ext.lang.global.langId],
                action: 'add'
            },{
                iconCls: 'icon-print',
                text: Ext.lang.global.print[Ext.lang.global.langId],
                action: 'print'
            },{
                xtype: 'button',
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
            store: 'Sourcecodes',           
            xtype: 'grid',
            height: 300,
            columns: [{
                header: Ext.lang.mainmenu.master.sourcecode.sourcecode[Ext.lang.global.langId],
                dataIndex: 'sourceCode',
                flex:5
            },{
                header: Ext.lang.mainmenu.master.sourcecode.sourcetype[Ext.lang.global.langId],
                dataIndex: 'category',
                flex:4
            },{
                header: Ext.lang.mainmenu.master.sourcecode.shortName[Ext.lang.global.langId],
                dataIndex: 'shortCode',
                flex:2
            },{
                header: Ext.lang.mainmenu.master.sourcecode.length[Ext.lang.global.langId],
                dataIndex: 'codeLength',
                align:'center',
                flex:2
            },{
                header:Ext.lang.global.status[Ext.lang.global.langId],
                xtype: 'statuschecked',
                flex:2
            }]
        }]
    }]
});
