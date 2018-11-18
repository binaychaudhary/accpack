Ext.define('ExtMVC.view.sourcecode.Formulario', {
    extend: 'Ext.window.Window',
    alias : 'widget.sourcecodeform',
    requires: [
        'Ext.toolbar.Paging',
        'ExtMVC.store.general.sourcecodeCategoryStore'
    ],
    itemId:'sourcecodeform',

    title:Ext.lang.mainmenu.master.sourcecode.sourcecode[Ext.lang.global.langId],
    layout: 'fit',    
    autoShow: true,
    width:350,
    iconCls: 'icon-source-code',
    items : [
    {     
        xtype: 'form',  
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[
        {
            xtype:'container',
            padding: '10',
            border: false,
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
                name : 'sourceCode',
                itemId : 'sourceCode',
                fieldLabel: Ext.lang.mainmenu.master.sourcecode.sourcecode[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
            },{
                xtype: 'combo',
                itemId: 'categoryId',
                name:'categoryId',
                queryMode:'local',
                store:{
                    type:'sourcecodeCategoryStore'
                },
                displayField:'category',
                valueField:'id',
                fieldLabel: Ext.lang.mainmenu.master.sourcecode.sourcetype[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red'
            },{
                xtype: 'textfield',
                name : 'shortCode',
                itemId : 'shortCode',
                fieldLabel: Ext.lang.mainmenu.master.sourcecode.shortName[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red'
            },{
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9.]/,
                name : 'codeLength',
                itemId : 'codeLength',
                align:'center',
                fieldLabel: Ext.lang.mainmenu.master.sourcecode.length[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red'
            },{
                 // id: 'Auto',
                xtype: 'radiogroup',
                fieldLabel: Ext.lang.global.status[Ext.lang.global.langId],
                labelWidth:120,
                allowBlank:false,
                labelStyle:'color:red',
                vertical: true,
                items: [
                    { id:'AutoYes',boxLabel: Ext.lang.global.active[Ext.lang.global.langId], name: 'status', inputValue: '1', checked: true},
                    { id:'AutoNo',boxLabel:  Ext.lang.global.passive[Ext.lang.global.langId], name: 'status', inputValue: '0'},                                
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
                    text: Ext.lang.global.save[Ext.lang.global.langId],
                    iconCls: 'icon-save',
                    action:'save',
                    formBind:true,
                    margin:'0 10 0 10'
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
    }]    
});
