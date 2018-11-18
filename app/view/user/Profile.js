Ext.define('ExtMVC.view.user.Profile', {
    extend: 'Ext.window.Window',
    alias : 'widget.userprofile',
    itemId:'userprofile',
    

    title:'User Profile',
    layout: 'fit',    
    autoShow: true,
    width:500,
    
    iconCls: 'icon-user',
    //initComponent: function() {
        
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
                xtype: 'label',
                name : 'address',
                fieldLabel: 'User Name',
                itemId:'address'
            },{
                xtype: 'label',
                name : 'mobileno',
                fieldLabel: 'User Name',
                itemId:'mobileno'
            },{
               xtype: 'label',
                name : 'email',
                fieldLabel: 'User Name',
                itemId:'email'
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
    }]
});