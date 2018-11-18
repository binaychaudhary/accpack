Ext.define('ExtMVC.view.Org.Orgform', {
    extend: 'Ext.window.Window',
    alias : 'widget.orgform',
    requires: ['Ext.toolbar.Paging'],
    itemId:'orgform',
   

    title:Ext.lang.mainmenu.master.org.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.global.desc[Ext.lang.global.langId],
    layout: 'fit',    
    autoShow: true,
    width:400,
    
    iconCls: 'icon-organization',
    items:[{
        xtype: 'form',
        border: false,
        
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
            xtype:'container',
            layout:{
                type:'vbox',
                align:'stretch'
            },
            padding:10,
            items: [
            {
                xtype: 'textfield',
                name : 'id',
                fieldLabel: 'id',
                itemId:'id',
                hidden:true
            },{
                xtype: 'textfield',
                name : 'orgName',
                itemId : 'orgName',
                fieldLabel: Ext.lang.mainmenu.master.org.orgName[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                labelStyle:'color:red',
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId]
            },{
                xtype: 'textarea',
                name : 'address',
                itemId : 'address',
                fieldLabel: Ext.lang.mainmenu.master.org.address[Ext.lang.global.langId], 
                componentCls:'nepaliText',
                allowBlank:false,
                labelStyle:'color:red',
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId]
            },{
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9,-.]/,
                name : 'telephoneNo',
                itemId : 'telephoneNo',
                fieldLabel: Ext.lang.mainmenu.master.org.contactNo[Ext.lang.global.langId]
               
            },{
                xtype: 'textfield',
                name : 'email',
                fieldLabel: Ext.lang.mainmenu.master.org.emailAddress[Ext.lang.global.langId]
                
            },{
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                name : 'regdNo',
                itemId : 'regdNo',
                align:'center',
                fieldLabel: Ext.lang.mainmenu.master.org.regdNo[Ext.lang.global.langId],
                componentCls:'nepaliNumber'
            },{
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                name : 'title',
                itemId : 'title',
                align:'center',
                fieldLabel: 'Title'
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
                }
            ]
       }]
    }]
});
