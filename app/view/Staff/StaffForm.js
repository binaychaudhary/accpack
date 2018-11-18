Ext.define('ExtMVC.view.Staff.StaffForm', {
    extend: 'Ext.window.Window',
    alias : 'widget.staffform',
    requires: ['Ext.toolbar.Paging'],
    itemId:'staffform',
    requires: [
       'ExtMVC.store.Designations'
    ],

    title:Ext.lang.mainmenu.master.employee.emp[Ext.lang.global.langId]+' '+Ext.lang.global.desc[Ext.lang.global.langId],
    layout: 'fit',    
    autoShow: true,
    width:400,
    
    iconCls: 'icon-employee',
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
                xtype: 'textfield',
                name : 'id',
                fieldLabel: 'id',
                itemId:'id',
                hidden:true
            },    
            {
                xtype: 'textfield',
                name : 'staffName',
                fieldLabel: Ext.lang.mainmenu.master.employee.empname[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage,
                labelStyle:'color:red',
                labelWidth:130
            },
            {
                xtype:'combo',
                fieldLabel:Ext.lang.mainmenu.master.employee.post[Ext.lang.global.langId],
                name:'designationId',
                itemId:'designationId',
                queryMode:'local',
                store:{
                    type:'Designations'
                },
                displayField:'designation',
                valueField:'id',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelWidth:130,
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red'
            },
            {
                xtype: 'textfield',
                name : 'address',
                enableKeyEvents: true,
                inputmethod: 'nepali',
                fieldLabel: Ext.lang.mainmenu.master.employee.address[Ext.lang.global.langId],
                componentCls:'nepaliText',
                labelWidth:130
            },
            {
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9.]/,
                name : 'mobileNo',
                fieldLabel: Ext.lang.mainmenu.master.employee.mobileNo[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                labelWidth:130                
            },
            {
                xtype: 'textfield',
                name : 'email',
                fieldLabel: Ext.lang.mainmenu.master.employee.emailAddress[Ext.lang.global.langId],
                labelWidth:130
            },
            {
                 // id: 'Auto',
                xtype: 'radiogroup',
                fieldLabel: Ext.lang.global.status[Ext.lang.global.langId],
                vertical: true,
                labelWidth:130,
                items: [
                    { id:'AutoYes',boxLabel: Ext.lang.global.active[Ext.lang.global.langId], name: 'status', inputValue: '1', checked: true},
                    { id:'AutoNo',boxLabel: Ext.lang.global.passive[Ext.lang.global.langId], name: 'status', inputValue: '0'}
                ]
                
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
                    margin:'0 10 10 10',
                    formBind:true
                },
                {
                    xtype: 'button',
                    iconCls: 'icon-close',
                    text: Ext.lang.global.close[Ext.lang.global.langId],
                    action:'close',
                    handler:function(buttons,e){
                        var x=Ext.ComponentQuery.query("window[itemId=staffform]")[0];
                        x.close();
                    }
                }
            ]
       }]
    }]
});