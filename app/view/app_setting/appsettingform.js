Ext.define('ExtMVC.view.app_setting.appsettingform', {
    extend: 'Ext.window.Window',
    alias : 'widget.appsettingform',
    itemId:'appsettingform',
    title:'App Setting',
    layout: 'fit',    
    autoShow: true,
    width:350,
   
    
    items:[{
        xtype: 'form',
        //margin: 5,
        border: false,
        bodyPadding:10,
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
            xtype: 'textfield',
            itemId:'id',
            name:'id',
            fieldLabel:'Id',
            hidden:true
        },{
            xtype: 'textfield',
            itemId:'setting_name',
            name:'setting_name',
            allowBlank:false,
            fieldLabel:'Setting Name',
            listeners: {
              afterrender: function(field) {
                field.focus(false, 1000);
              }
            }
        },{
            xtype:'textfield',
            itemId:'value_txt',
            name:'value_txt',
            fieldLabel:'Value Text',
            allowBlank:false
        }],
        dockedItems: [{
            dock: 'bottom',
            ui: 'footer',
            xtype: 'toolbar',
            items: [{
                xtype: 'button',
                text: Ext.lang.global.save[Ext.lang.global.langId],
                iconCls: 'icon-save',
                action:'save',
                margin:'0 10 0 10',
                formBind:true
            },
            {
                xtype: 'button',
                iconCls: 'icon-close',
                text: Ext.lang.global.close[Ext.lang.global.langId],
                action:'close',
                handler:function(buttons,e){
                    var x=buttons.up('window');
                    x.close();
                }
            }]
       }]
    }]
});
