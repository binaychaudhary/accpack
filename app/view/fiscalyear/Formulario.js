Ext.define('ExtMVC.view.fiscalyear.Formulario', {
    extend: 'Ext.window.Window',
    alias : 'widget.fiscalyearform',
    requires: ['Ext.toolbar.Paging','ExtMVC.dateConverter.DateHelper'],
    itemId:'fiscalyearform',
    title:Ext.lang.mainmenu.master.fiscalyear.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.global.desc[Ext.lang.global.langId],
    layout: 'fit',    
    autoShow: true,
    width:350,    
    iconCls: 'icon-user',
    items : [
    {
        xtype: 'form',
        itemId:'form',
        layout:{
            type:'vbox',
            align:'stretch'
        },
        items:[{
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
                fieldLabel: 'Code',
                hidden:true
            },    
            {
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                name : 'fiscalyear',
                itemId:'fiscalyear',
                labelWidth:120,
                fieldLabel: Ext.lang.mainmenu.master.fiscalyear.fiscalyear[Ext.lang.global.langId],
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red'
            },
            {
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                labelWidth: 120,
                maxLength:10,
                emptyText:'YYYY/MM/DD',
                fieldLabel: Ext.lang.mainmenu.master.fiscalyear.startDateBs[Ext.lang.global.langId],
                itemId: 'start_date_bs',
                name:'start_date_bs',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
                listeners: {
                    blur: function() {
                        //debugger;
                      var dtad = Ext.ComponentQuery.query("datefield[itemId=start_date_ad]")[0];
                      var dtbs = Ext.ComponentQuery.query("textfield[itemId=start_date_bs]")[0];
                      var hp = new DateHelper();
                      
                      var convDateAd=hp.ConvertBsToAd(dtbs.value);
                      dtad.setValue( new Date(convDateAd));
                    }
                }
            },{
                xtype: 'textfield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                labelWidth: 120,
                fieldLabel: Ext.lang.mainmenu.master.fiscalyear.endDateBs[Ext.lang.global.langId],
                emptyText:'YYYY/MM/DD',
                itemId: 'end_date_bs',
                name:'end_date_bs',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
                listeners: {
                    blur: function() {
                      var dtad = Ext.ComponentQuery.query('#end_date_ad')[0];
                      var dtbs = Ext.ComponentQuery.query("textfield[itemId=end_date_bs]")[0];

                      var hp = new DateHelper();
                      var convDateAd=hp.ConvertBsToAd(dtbs.value);
                      dtad.setValue( new Date(convDateAd));
                    }
                }
            },
            {
                xtype: 'datefield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                labelWidth: 120,
                fieldLabel: Ext.lang.mainmenu.master.fiscalyear.startDateAd[Ext.lang.global.langId],
                itemId: 'start_date_ad',
                name:'start_date_ad',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
                listeners: {
                    blur: function() {
                        Ext.ComponentQuery.query('#form')[0]
                        var dtad =Ext.ComponentQuery.query('#start_date_ad')[0];
                        var dtbs = Ext.ComponentQuery.query("textfield[itemId=start_date_bs]")[0];
                        var hp = new DateHelper();
                        var convDateBs=hp.ConvertAdToBs(dtad.value);
                        dtbs.setValue( convDateBs);
                    }
                }
            },{
                xtype: 'datefield',
                componentCls:'nepaliNumber',
                maskRe: /[0-9./]/,
                labelWidth: 120,
                fieldLabel: Ext.lang.mainmenu.master.fiscalyear.endDateAd[Ext.lang.global.langId],
                itemId: 'end_date_ad',
                name:'end_date_ad',
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
                listeners: {
                    blur: function() {
                        var dtad = Ext.ComponentQuery.query('#end_date_ad')[0];
                        var dtbs = Ext.ComponentQuery.query("textfield[itemId=end_date_bs]")[0];
                        var hp = new DateHelper();
                        var convDateBs=hp.ConvertAdToBs(dtad.value);
                        dtbs.setValue( convDateBs);
                    }
                }
            },
            {
                 // id: 'Auto',
                xtype: 'radiogroup',
                fieldLabel: Ext.lang.global.status[Ext.lang.global.langId],
                labelWidth:120,
                vertical: true,
                componentCls:'nepaliNumber',
                allowBlank:false,
                blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                labelStyle:'color:red',
                items: [
                    { id:'AutoYes',boxLabel: Ext.lang.global.active[Ext.lang.global.langId], name: 'status', inputValue: '1', checked: true},
                    { id:'AutoNo',boxLabel:  Ext.lang.global.passive[Ext.lang.global.langId], name: 'status', inputValue: '0'}
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
                    var x=buttons.up('window');
                    x.close();
                }
            }]
        }]
    }]
});