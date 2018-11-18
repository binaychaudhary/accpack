Ext.define('ExtMVC.view.user.Changepass', {
    extend: 'Ext.window.Window',
    alias : 'widget.changeform',
    requires: ['Ext.toolbar.Paging','ExtMVC.store.general.RoleStore'],
    itemId:'changeform',
   

    title:'Change Password',
    layout: 'fit',    
    autoShow: true,
    width:350,
    
    iconCls: 'icon-user',
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
                xtype: 'label',
                name : 'username',
                fieldLabel: 'User Name',
                itemId:'username'
                
            },{
                xtype: 'textfield',
                itemId : 'currentpass',
                fieldLabel: 'Current Password',
                inputType: 'password',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage,
                cls:'required-field-label'
            },{
                xtype: 'textfield',
                itemId : 'newpass',
                inputType: 'password',
                fieldLabel: 'New Password',
                disabled:true
                // allowBlank:false,
                // blankText:Ext.lang.msg.blankMessage,
                // cls:'required-field-label'
            },{
                xtype: 'textfield',
                itemId : 'repass',
                inputType: 'password',
                fieldLabel: 'Re-type Password',
                disabled:true
                // allowBlank:false,
                // blankText:Ext.lang.msg.blankMessage,
                // cls:'required-field-label'
            }]

        }],
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
                    text: Ext.lang.global.checkPass,
                    iconCls: 'icon-save',
                    action:'save',
                    margin:'0 10 0 10',
                    formBind:true
                },
                {
                    xtype: 'button',
                    iconCls: 'icon-close',
                    text: 'Close',
                    action:'close',
                    handler:function(buttons,e){
                        var x= buttons.up('window');
                        x.close();
                    }
                }
            ]
        }]
    }]
});
