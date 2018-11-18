Ext.define('ExtMVC.view.Login', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.loginform',
    itemId:'loginform',
    requires:[
        'ExtMVC.store.general.Language'
        // 'ExtMVC.view.segment.TranOpener',
        // 'ExtMVC.dateConverter.DateHelper'
    ],
    //title:Ext.lang.login.menuTitle,
    layout: 'fit',    
    autoShow: true,
    //width:300,
   // style:'background-image: resources/images/desktop.jpg',
   // iconCls: 'icon-user',
    layout:{
        type:'hbox',
        align:'stretch'
    },
    bodyPadding:10,
    items:[{
        xtype: 'form',
        border: false,
        items: [{
            xtype:'container',
            padding:'0 0 0 60',
            itemId:'topContainer',
            cls:'transparent',
            layout:{
                type:'hbox',
                align:'stretch'
            },
            items:[{
                xtype:'container',
                layout:{
                    type:'vbox'
                    // align:'middle',
                    // pack:'center'
                },
                items:[{
                    xtype   :'container',
                    padding:'20 0 80 0',
                    layout:{
                        type:'hbox',
                        align:'stretch'
                    },
                    items:[{
                        xtype   :'image',
                        src:'resources/images/webpay.png',
                        height  :25,
                        width   :55
                    },{
                        xtype:'container',
                        //flex:1,
                        //style:'border:1; border-color:blue; background-color:#000',
                        layout:{
                            type:'vbox',
                            align:'center',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            text:'AccPack',
                            style:'font-family:cooper black; font-size:45; font-weight:bolder; color:#FB6627'
                        },{
                            xtype:'label',
                            //text:Ext.lang.global.appNature[Ext.lang.global.langId],
                            style:'font-family:Arial Narrow; font-size:16; font-weight:bolder; color:#BC7F1E;'
                        }]            
                    }]
                },{
                    xtype:'container',
                    layout:{
                        type:'hbox'
                    },
                    items:[{                        
                        xtype: 'radiogroup',
                        fieldLabel: 'Language',
                        id:'language',
                        vertical: false,
                        columns:2,
                        items: [
                            { boxLabel: 'English', name: 'langId',  inputValue: '0', width:70, checked: true},
                            { boxLabel: 'नेपाली', name: 'langId',   inputValue: '1', width:70}
                        ]
                    }]
                },{
                    xtype:'container',
                    layout:{
                        type:'hbox'
                    },
                    items:[{
                        xtype: 'textfield',
                        itemId : 'txtEmail',
                        value:null,
                        fieldLabel: Ext.lang.login.userEmail[Ext.lang.global.langId],
                        lableWidth:20,
                        allowBlank:false,
                        //labelClsExtra:'required-field-label',
                        blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId],
                        labelStyle:'color:#000'
                    }]
                },{
                    xtype:'container',
                    layout:{
                        type:'hbox'
                    },
                    items:[{
                        xtype: 'textfield',
                        itemId : 'txtPass',
                        inputType: 'password',
                        placeHolder: Ext.lang.login.password[Ext.lang.global.langId],
                        fieldLabel: Ext.lang.login.password[Ext.lang.global.langId],
                        lableWidth:20,
                        value:null,
                        minLength:4,
                        maxLength:8,
                        allowBlank:false,
                        labelStyle:'color:#000',
                        //labelCls:'required-field-label',
                        blankText:Ext.lang.msg.blankMessage[Ext.lang.global.langId]
                    }]
                },{
                    xtype:'container',
                    layout:{
                        type:'hbox',
                        align:'center',
                        pack:'start'
                    },
                    margin:'10 0 0 105',
                    items: [ 
                    { 
                        xtype: 'button', // #25 
                        itemId: 'reset', 
                        iconCls: 'icon-reset', 
                        action:'reset',
                        text:Ext.lang.global.reset[Ext.lang.global.langId]
                    }, { 
                        xtype: 'button', // #26 
                        itemId: 'submit', 
                        formBind: true, // #27 
                        iconCls: 'icon-login',
                        text:Ext.lang.login.loginButton[Ext.lang.global.langId],
                        action:'login',
                        margin:'0 0 0 10'
                    }] 
                }]
            },{
                xtype:'tbfill'
            },{
                xtype:'container',
                margin:'0 40 0 0',
                padding:10,
                width:175,
                style:'background-image:url(resources/images/calender.jpg); background-repeat:no-repeat',
                layout:{
                    type:'vbox'
                },
                items:[{
                    xtype:'container',
                    width:150,
                    layout:{
                        type:'hbox',
                        align:'middle',
                        pack:'center'
                    },
                    items:[{
                        xtype:'label',
                        itemId:'dtAd',
                        style: 'font-size:18; padding-top:37'
                    }]
                },{
                    xtype:'container',
                    width:150,
                    layout:{
                        type:'hbox',
                        align:'middle',
                        pack:'center'
                    },
                    items:[{
                        xtype:'label',
                        itemId:'dt',
                        style: 'font-size:30; padding-top:15'
                    }]
                },{
                    xtype:'container',
                    width:150,
                    layout:{
                        type:'hbox',
                        align:'middle',
                        pack:'center'
                    },
                    items:[{
                        xtype:'label',
                        itemId:'yr' ,
                        style:'font-size:30; font-weight:bolder'
                    }]
                    
                }]
            }]

        },{
            xtype   :'tbfill'            
        },{
            xtype   :'container',
            itemId:'bottomContainer',
            style:'background-image:url(resources/images/back.png); color:#fff;',
            height:400,
            layout  :{
                type :'hbox',
                align:'stretch'
            },
            items:[{
                xtype:'container',
                margin:'228 50 0 0',
                layout:{
                    type:'vbox',
                    align:'stretch'
                },
                items:[{
                    xtype   :'label',
                    text:'Developed By'
                },{
                    xtype   :'label',
                    text:Ext.lang.global.developerName[Ext.lang.global.langId],
                    style:'font-size:24; padding-top:7; font-weight:bolder'
                },{
                    xtype   :'label',
                    text:Ext.lang.global.address[Ext.lang.global.langId]+': '+Ext.lang.global.developerAddress[Ext.lang.global.langId]

                },{
                    xtype:'label',
                    itemId:'branch',
                    text:Ext.lang.global.branch[Ext.lang.global.langId]
                },{
                    xtype   :'label',
                    text:Ext.lang.global.contactNo[Ext.lang.global.langId]+': '+Ext.lang.global.developerContactNo[Ext.lang.global.langId]
                },{
                    xtype   :'label',
                    text:'Website: '+Ext.lang.global.developerWebsite[Ext.lang.global.langId]
                },{
                    xtype   :'label',
                    text:'Email:' + Ext.lang.global.developerEmail[Ext.lang.global.langId]
                }]
            },{
                xtype:'tbfill'
            },{
                xtype:'container',
                padding:'155 50 0 50',
                layout:{
                    type:'vbox'
                },
                items:[{
                    xtype   :'label',
                    text:'Lisenced To',
                    style:'font-size:14; padding-top:7; color: #fff'
                },{
                    xtype   :'label',
                    itemId:'orgName',
                    text:'Pioneer Academy',
                    style:'font-size:26; padding-top:7; color: red; font-weight:bolder'
                },{
                    xtype   :'label',
                    itemId:'orgAddress',
                    style:'font-size:18; color: red'
                },{
                    xtype   :'label',
                    itemId:'orgContactNo',
                    style:'font-size:18; color: red'
                },{
                    xtype   :'label',
                    itemId:'orgEmail',
                    style:'font-size:18; color: red'
                }]
            }]
        }]
    }]   
});