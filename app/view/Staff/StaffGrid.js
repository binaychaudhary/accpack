Ext.define('ExtMVC.view.Staff.StaffGrid' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.staffgrid',
    itemId:'staffgrid',
    width:1000,
    title: Ext.lang.mainmenu.master.employee.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],            
    requires: [
        'ExtMVC.store.Designations'
    ],
    iconCls :'icon-employee',
    items:[{
        xtype:'container',
        itemId:'mainContainer',
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
            xtype: 'form',
            width:'100%',
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
                itemId: 'staffName',
                labelWidth:130,
                padding: '0 10 0 0',
                fieldLabel: Ext.lang.mainmenu.master.employee.empname[Ext.lang.global.langId],
                flex:5
            },
            {
                xtype:'combo',
                fieldLabel:Ext.lang.mainmenu.master.employee.post[Ext.lang.global.langId],
                labelWidth:40,
                name:'designationId',
                itemId:'designationId',
                queryMode:'local',
                padding: '0 10 0 0',
                store:{
                    type:'Designations'
                },
                displayField:'designation',
                valueField:'id',
                flex:4
            },
            {
                xtype:'combo',
                fieldLabel:Ext.lang.global.status[Ext.lang.global.langId],
                labelWidth:55,
                name:'status',
                itemId:'status',
                queryMode:'local',
                store:{
                    type:'statusStore'
                },
                displayField:'name',
                valueField:'value',
                flex:4,
                padding: '0 10 0 0'
                
            },{
                xtype: 'button',
                itemId: 'btnSearch',
                iconCls:'icon-search',
                text: Ext.lang.global.search[Ext.lang.global.langId],
                action:'search',
                hidden:true             
            }]
        },{
            xtype: 'toolbar',
            items: [{
                iconCls: 'icon-add',
                itemId: 'add',
                text: Ext.lang.global.add[Ext.lang.global.langId],
                action: 'add'
            },{
                iconCls: 'icon-delete',
                text: Ext.lang.global.del[Ext.lang.global.langId],
                action: 'delete',
                itemId: 'btnDelete',
                hidden:true
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
            store: 'Staffs',
            xtype: 'grid',
            height: 300,
            columns: [{
            
                header: Ext.lang.mainmenu.master.employee.empname[Ext.lang.global.langId],
                dataIndex: 'staffName',
                flex:5
            },{
                header: Ext.lang.mainmenu.master.employee.post[Ext.lang.global.langId],
                dataIndex: 'designation',
                flex:4
            },{
                header: Ext.lang.mainmenu.master.employee.address[Ext.lang.global.langId],
                dataIndex: 'address',
                flex:4
            },{
                header: Ext.lang.mainmenu.master.employee.mobileNo[Ext.lang.global.langId],
                dataIndex: 'mobileNo',
                flex:3
            },{
                header: Ext.lang.mainmenu.master.employee.emailAddress[Ext.lang.global.langId],
                dataIndex: 'email',
                flex:5
            },{
                header:Ext.lang.global.status[Ext.lang.global.langId],
                xtype: 'statuschecked',
                flex:2
            }]
        }]    
    }]
});