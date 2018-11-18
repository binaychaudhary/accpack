Ext.define('ExtMVC.view.fiscalyear.Grid' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.fiscalyeargrid',
    itemId:'fiscalyeargrid',
    requires: [
        'Ext.toolbar.Paging','ExtMVC.utility.StatusChecked',
        'ExtMVC.store.general.StatusStore'
    ],
    iconCls:'icon-fy',
    width:700,
    title:Ext.lang.mainmenu.master.fiscalyear.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
    items:[{
        xtype:'container',
        flex:1,
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
            xtype: 'form',
            itemId:'form',
            dock: 'top',
            bodyPadding: 10,
            collapsible: true,
            title: Ext.lang.global.searchTitle[Ext.lang.global.langId],
            iconCls: 'icon-grid',
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [
                {
                    xtype: 'textfield',
                    componentCls:'nepaliNumber',
                    maskRe: /[0-9/]/,
                    itemId: 'fiscalyear',
                    padding: '0 20 0 0',
                    fieldLabel: Ext.lang.mainmenu.master.fiscalyear.fiscalyear[Ext.lang.global.langId],
                    flex:4
                },
                {
                    xtype:'combo',
                    fieldLabel:Ext.lang.global.status[Ext.lang.global.langId],
                    labelWidth:50,
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
                    
                }
                // ,{
                //     xtype: 'button',
                //     itemId: 'btnSearch',
                //     iconCls:'icon-search',
                //     text: Ext.lang.global.search,
                //     action:'search',
                //     //hidden:true
                // }
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
            xtype: 'grid',
            store: 'Fiscalyears',
            itemId:'fiscalyearlist',
            columns: [{
                header: Ext.lang.mainmenu.master.fiscalyear.menuTitle[Ext.lang.global.langId],
                dataIndex: 'fiscalyear',
                flex:15,
                align:'center'
            },{
                header: Ext.lang.mainmenu.master.fiscalyear.startDateBs[Ext.lang.global.langId],
                dataIndex: 'start_date_bs',
                flex:20,
                align:'center'
            },{
                header: Ext.lang.mainmenu.master.fiscalyear.endDateBs[Ext.lang.global.langId],
                dataIndex: 'end_date_bs',
                flex:20,
                align:'center'
            },{
                header: Ext.lang.mainmenu.master.fiscalyear.startDateAd[Ext.lang.global.langId],
                dataIndex: 'start_date_ad',
                flex:20,
                align:'center'
            },{
                header: Ext.lang.mainmenu.master.fiscalyear.endDateAd[Ext.lang.global.langId],
                dataIndex: 'end_date_ad',
                flex:20,
                align:'center'
            },{
                header:Ext.lang.global.status[Ext.lang.global.langId],
                xtype: 'statuschecked',
                flex:10,
                align:'center'
            }]
        },{
            xtype: 'pagingtoolbar',
            dock:'top',
            store: 'Fiscalyears',
            displayInfo: true,
            displayMsg: 'Record {0} - {1} of {2}',
            emptyMsg: "No Record Found",
            hidden:true
        }]
    }]
});
