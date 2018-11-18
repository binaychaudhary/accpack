Ext.define('ExtMVC.view.Org.Orggrid' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.orggrid',
    iconCls: 'icon-organization',
    itemId:'orggrid',
    title : Ext.lang.mainmenu.master.org.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
    width:900,
    items:[{
        xtype:'container',
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
            xtype: 'toolbar',
            items: [{
                iconCls: 'icon-add',
                text: Ext.lang.global.add[Ext.lang.global.langId],
                action: 'add'
            },{
                iconCls: 'icon-print',
                text: Ext.lang.global.print[Ext.lang.global.langId],
                itemId:'btnPrint',
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
            xtype:'grid',
            store: 'Orgs',
            height:150,
            columns: [{
                header: Ext.lang.mainmenu.master.org.orgName[Ext.lang.global.langId],
                flex:5,
                dataIndex: 'orgName'
            },{
                header: Ext.lang.mainmenu.master.org.address[Ext.lang.global.langId],
                flex:4,
                dataIndex: 'address'
            },{
                header: Ext.lang.mainmenu.master.org.contactNo[Ext.lang.global.langId],
                flex:3,
                dataIndex: 'telephoneNo'
            },{
                header: Ext.lang.mainmenu.master.org.emailAddress[Ext.lang.global.langId],
                flex:5,
                dataIndex: 'email'
            },{
                header: Ext.lang.mainmenu.master.org.regdNo[Ext.lang.global.langId],
                flex:3,
                dataIndex: 'regdNo'
            }]        
        }]        
    }]
});