Ext.define('ExtMVC.view.user.Formulario', {
    extend: 'Ext.window.Window',
    alias : 'widget.userform',
    requires: ['Ext.toolbar.Paging','ExtMVC.store.general.RoleStore'],
    itemId:'userform',
   

    title:'User Setup',
    layout: 'fit',    
    autoShow: true,
    width:350,
    
    iconCls: 'icon-user1',
        
    items : [
    {
        xtype: 'form',
        itemId:'userform',
        //padding: '5 5 0 5',
        border: false,
        layout:{
            type:'vbox',
            align:'stretch'
        },
        
        items:[{
            xtype:'container',
            padding:'10',
            layout:{
                type:'vbox',
                align:'stretch'
            },
            items: [
            {
                xtype: 'textfield',
                name : 'id',
                fieldLabel: 'id',
                itemId:'id',
                hidden:true
            },{
                xtype: 'textfield',
                name : 'userName',
                componentCls:'nepaliText',
                fieldLabel: 'Full Name',
                componentCls:'nepaliNumber',
                    allowBlank:false,
                    blankText:Ext.lang.msg.blankMessage,
                    labelStyle:'color:red'
            },{
                xtype: 'textfield',
                name : 'address',
                fieldLabel: 'Address'
            },{
                xtype: 'textfield',
                name : 'mobileNo',
                componentCls:'nepaliNumber',
                maskRe: /[0-9.]/,
                fieldLabel: 'Contact No'
            },{
                xtype: 'textfield',
                name : 'email',
                fieldLabel: 'Email',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage,
                labelStyle:'color:red'
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
                fieldLabel: 'Role',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage,
                labelStyle:'color:red'
                //flex:5
            },
            {
                xtype: 'radiogroup',
                fieldLabel: 'Status',
                vertical: true,
                items: [
                    { id:'AutoYes',boxLabel: Ext.lang.global.active, name: 'status', inputValue: '1', checked: true},
                    { id:'AutoNo',boxLabel: Ext.lang.global.passive, name: 'status', inputValue: '0'}
                ]                
            }]
        },{
            dockedItems: [{
                dock: 'bottom',
                ui: 'footer',
                xtype: 'toolbar',
                layout: {
                    type: 'hbox',
                    align: 'middle',
                    pack: 'center'
                },
                items: [
                {
                    xtype: 'button',
                    itemId:'btnSave',
                    text: Ext.lang.global.save,
                    iconCls: 'icon-save',
                    action:'save',
                    margin:'0 10 0 10',
                    formBind:true
                },
                {
                    xtype: 'button',
                    iconCls: 'icon-close',
                    text: Ext.lang.global.close,
                    action:'close',
                    handler:function(buttons,e){
                        var x=buttons.up('window');
                        x.close();
                    }
                }]
            }]
        }]
    }]
});
