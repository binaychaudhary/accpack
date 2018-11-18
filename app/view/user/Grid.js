Ext.define('ExtMVC.view.user.Grid' ,{
    extend: 'Ext.panel.Panel',
    alias : 'widget.usergrid',
    itemId:'usergrid',
    requires: [
        'Ext.toolbar.Paging','ExtMVC.utility.StatusChecked',
        'ExtMVC.store.general.StatusStore',
        'ExtMVC.store.general.RoleStore'
    ],
    width:950,
    iconCls :'icon-user1',
    title:'User',
    modal:true,
    items:[{
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
            title: Ext.lang.global.user,
            iconCls: 'icon-grid',
            layout: {
                type: 'hbox',
                align: 'fit'
            },
            items: [
                {
                    xtype: 'textfield',
                    itemId: 'userName',
                    padding: '0 20 0 0',
                    fieldLabel: Ext.lang.global.user,
                    flex:5
                },{
                    xtype: 'combo',
                    itemId: 'roleId',
                    name:'roleId',
                    queryMode:'local',
                    store:{
                        type:'roleStore'
                    },
                    displayField:'role',
                    valueField:'id',
                    padding: '0 20 0 0',
                    fieldLabel: Ext.lang.global.role,
                    flex:5
                },
                {
                    xtype:'combo',
                    fieldLabel:Ext.lang.global.status,
                    labelWidth:40,
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
                    margin: '0 20 0 0',
                    width: 70,
                    text: Ext.lang.global.search,
                    action:'search'
                }
            ]
        },{
            xtype: 'toolbar',
            items: [{
                iconCls: 'icon-add',
                itemId: 'add',
                text: Ext.lang.global.add,
                action: 'add'
            },{
                iconCls: 'icon-print',
                text: Ext.lang.global.print,
                action: 'print'  
            },{
                iconCls: 'icon-delete',
                text: Ext.lang.global.delete,
                action: 'delete'  
            },{
                xtype: 'button',
                iconCls: 'icon-close',
                text: Ext.lang.global.close,
                action:'close',
                handler:function(buttons,e){
                    var parent = Ext.ComponentQuery.query('#contentPanel')[0];
                    var w = parent.getActiveTab();
                    w.close();
                }          
            }]
        },{
            store: 'Users',
            xtype: 'grid',
            cls:'x-grid-cell-inner',
            height: 350,
            columns: [{
                header: Ext.lang.global.user,
                dataIndex: 'userName',
                flex:5
            },{
                header: Ext.lang.global.address,
                dataIndex: 'address',
                flex:5
            },{
                header: 'Contact No',
                dataIndex: 'mobileNo',
                componentCls:'nepaliNumber',
                flex:3
            },{
                header: 'Email Address',
                dataIndex: 'email',
                flex:6
            },{
                header: Ext.lang.global.role,
                dataIndex: 'role',
                flex:3
            },{
                header:Ext.lang.global.status,
                xtype: 'statuschecked',
                flex:2
           }]
        }]
    }]
});
