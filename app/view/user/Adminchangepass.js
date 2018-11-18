Ext.define('ExtMVC.view.user.Adminchangepass', {
    extend: 'Ext.window.Window',
    alias : 'widget.adminchange',
    itemId:'adminchange',
   
        
    title:'प्रयाेगकर्ता',
    layout: 'fit',    
    autoShow: true,
    width:350,
    
    iconCls: 'icon-change-password',
        
    items : [
    {
        xtype: 'form',
        
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
                xtype: 'combo',
                name : 'username',
                fieldLabel: 'User Name',
                itemId:'username',
                store:'Users',
                displayField:'userName',
                valueField:'id'
                
            },{
                xtype: 'textfield',
                itemId : 'newpass',
                fieldLabel: 'Password',
                inputType: 'password'
                
            },{
                xtype: 'textfield',
                itemId : 'repass',
                fieldLabel: 'Re-type Password',
                inputType: 'password'
                
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
                        name:'btnSave',
                        text: Ext.lang.global.changePassword,
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
                            var x= buttons.up('window');
                            x.close();
                        }
                    }
                ]
            }]
        }]
    }]       
});