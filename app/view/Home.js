Ext.define('ExtMVC.view.Home', {
    extend: 'Ext.panel.Panel',
    alias : 'widget.homeform',
    itemId:'homeform',
    requires: [
        // 'Ext.menu.Menu',
        // 'Ext.menu.Item',
        'ExtMVC.lib.MyLib',
        'ExtMVC.dateConverter.DateHelper'
        // 'ExtMVC.view.CalcLoanInt.Grid',
        // 'ExtMVC.view.DateChange.ChangeDate',
        // 'ExtMVC.view.app_setting.app_settinggrd',
        // 'ExtMVC.view.SalesReturn.SalesReturnGrid',
        // 'ExtMVC.view.acgroups.AcgroupGrid',
        //'ExtMVC.view.Menu'
    ],   
    itemId: 'mainView',
    //layout: 'border',
    width:960,
    items: [{
        region: 'north',     // position for region
        xtype: 'form',
        itemId:'banner',
        split: true,         // enable resizing
        border:false,
        height:75,
        layout:{
            type:'hbox',
            align:'stretch'
        },
        items:[{
            xtype:'container',
            width:220,
            style:'border:1; bolder-color:blue; background-color:#BDD3EF',
            layout:{
                type:'vbox',
                align:'center',
                pack:'center'
            },
            items:[{
                padding:'5 0 0 5',
                xtype:'label',
                text: Ext.lang.global.productName[Ext.lang.global.langId],
                style:'font-family:cooper black; font-size:30; font-weight:bolder; color:#FB6627'            
            }]            
        },{
            xtype:'container',
            style:'border:2px; border-color:blue; background-color:#000',
            flex:5,
            layout:{
                type:'hbox',
                align:'stretch'
            },
            items:[{
                
                
            },{                
                xtype:'container',
                flex:6,
                layout:{
                    type:'vbox',
                    align:'center',
                    pack:'center'
                },
                style:'font-family:century gothic',
                items:[{
                    xtype:'label',
                    itemId:'orgTitle',
                    style:'font-size:15 ; font-weight: bold; color:#fff'
                },{
                    xtype:'label',
                    itemId:'orgName',
                    style:'font-size:20; color:#fff'
                },{
                    xtype:'label',
                    itemId:'orgAddress',
                    style:'font-size:15; color:#fff'
                }]
            }]
        },{     
            xtype:'container',
            layout:{
                type:'vbox',
                align:'stretch'
            },
            width:250,
            style:'background-color:#000',
            items:[{
                xtype:'container',
                itemId:'DtFy',
                name:'DtFy',
                flex:2,
                //padding:'0 0 0 5',
                layout:{
                    type:'vbox',
                    align:'stretch'
                },
                items:[{
                    xtype:'container',
                    margin:'5 0 5 10',
                    layout:{
                        type:'hbox'
                    },
                    items:[{
                        xtype:'image',
                        src:'resources/images/calender.png'
                    },{
                        xtype:'label',
                        itemId:'currFiscalYear',
                        baseCls:'nepaliNumber',
                        text:' ',
                        padding:'0 0 0 5',
                        style:'font-size:12; color:#fff'                        
                    }]

                },{
                    xtype:'container',
                    margin:'0 0 5 10',
                    layout:{
                        type:'hbox'
                    },
                    items:[{
                        xtype:'image',
                        src:'resources/images/calender.png'
                    },{
                        xtype:'label',
                        itemId:'currDate',
                        baseCls:'nepaliNumber',
                        text:' ',
                        padding:'0 0 0 5',
                        style:'font-size:12; color:#fff'                        
                    }]                        
                }]
            },{
                xtype:'container',
                itemId:'userCr',
                name:'userCr',
                flex:2,
                layout:{
                    type:'hbox'
                   // align:'center',
                   // pack:'end'
                },
                //flex:2,
                padding:'10 5 0 10',
                items:[{
                    xtype:'label',
                    itemId:'lblUserName',
                    text:'',
                    style:'color:#fff;',
                    padding:'0 10 0 0'
                },{
                     xtype: 'button',
                    iconCls: 'icon-setting',
                    itemId: 'log_utility',
                    style:'color:#fff; background-color: #000',
                    disabled:true,
                    menu: {
                        items: [{
                            text: Ext.lang.login.profile[Ext.lang.global.langId],
                            iconCls: 'icon-profile',
                          
                            listeners:{
                                click: function(){
                                    var pnl = new ExtMVC.view.user.Profile();
                                   pnl.show();
                                }
                            }
                        },{
                           text: 'Profile Picture',
                            iconCls: 'icon-user',                              
                            listeners:{
                                click: function(){
                                    var pnl = new ExtMVC.view.user.ProfilePicture();
                                    var f = pnl.down('form');
                                    var id = f.query('#id')[0];
                                    var userName = f.query('#username')[0];
                                    id.setValue(Ext.state.Manager.get("uId"));
                                    userName.setValue(Ext.state.Manager.get("uName"));
                                   pnl.show();
                                }
                            } 
                        }, {
                            text: Ext.lang.login.changePassword[Ext.lang.global.langId],
                            iconCls :'icon-change-password',
                            listeners:{ 
                                click: function(){
                                    var pnl = new ExtMVC.view.user.Changepass();
                                    pnl.show();
                                }
                            }
                        }, {
                            text: Ext.lang.login.tr_close[Ext.lang.global.langId],
                            itemId: 'dayCloser',
                            iconCls :'icon-close-tran'
                        // }, {
                        //     text: 'Temprory Date Change',
                        //     listeners:{
                        //         click: function(){
                        //             var pnl = new ExtMVC.view.DateChange.ChangeDate();
                        //             pnl.show();
                        //         }
                        //     }
                        }, {
                          text: Ext.lang.login.logout[Ext.lang.global.langId],
                            iconCls: 'icon-logout',
                            itemId: 'logout'
                        }]
                    }    
                }]
            }]
        }]  
    },{
        //title: 'Center Region',
        region: 'center',     // center region is required, no width/height specified
        xtype: 'panel',
        itemId:'centerpanel',
        layout:{
            type:'hbox',
            align: 'stretch'
        },
        flex:5, 
        height:'100%',
        border:false,
        items:[{
            xtype: 'container',
            itemId:'menuContainer',
            //title:'Main Menu',
            height: 450,
            width: 225,
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [{
                xtype   :'container',
                itemId:'menuHolder',
                layout:{
                    type:'vbox',
                    align   :'stretch'
                },
                items:[{

                    xtype: 'menu',
                    itemId:'menumenu',
                    // set floating: false to allow the menu to participate
                    // in the parent container's layout
                    floating: false,
                    width: 222,
                    //title:'Main Menu',
                    items: [{
                        text:'<b>'+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId]+'</b>',
                        iconCls: 'icon-organization',
                        itemId:'m1',
                        menu: {
                            items: [{
                                text: Ext.lang.mainmenu.master.org.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-organization',
                                itemId: 'm1_1',
                                listeners: {
                                     click: function() {
                                        var pnl = new ExtMVC.view.Org.Orggrid({modal:true, closable:true});
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                     }
                                 }
                            }, {
                                text: 'App Settings',
                                iconCls: 'icon-segment',
                                itemId: 'm1_2',
                                listeners: {
                                     click: function() {
                                        var pnl = new ExtMVC.view.app_setting.app_settinggrd({modal:true, closable:true});
                                        pnl.down('form').query('#org_id')[0].setValue( Ext.state.Manager.get("gOrgId"));
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                     }
                                 }
                            }, {
                                text: Ext.lang.mainmenu.master.sourcecode.sourcecode[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-segment',
                                itemId: 'm1_3',
                                listeners: {
                                     click: function() {
                                        var pnl = new ExtMVC.view.sourcecode.Grid({modal:true, closable:true});
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                     }
                                 }
                            }, {
                                text: Ext.lang.mainmenu.master.fiscalyear.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-fy',
                                itemId: 'm1_4',
                                listeners: {
                                    click: function() {
                                        var pnl = new ExtMVC.view.fiscalyear.Grid({modal:true, closable:true});      
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                    }
                                }
                            }, {
                                text: Ext.lang.mainmenu.master.employee.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-user',
                                itemId: 'm1_5',
                                listeners: {
                                    click: function() {
                                        var pnl =new ExtMVC.view.Staff.StaffGrid({modal:true, closable:true});      
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                    }
                                }
                            }]
                        }
                    },{
                        text:'<b>'+Ext.lang.mainmenu.acsetup.menuTitle[Ext.lang.global.langId]+'</b>',
                        iconCls: 'icon-organization',
                        itemId:'m2',
                        menu: {
                            items: [{
                                text: Ext.lang.mainmenu.acsetup.acgroup.menuTitle[Ext.lang.global.langId]+' '+Ext.lang.mainmenu.master.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-organization',
                                itemId: 'm2_1',
                                listeners: {
                                     click: function() {
                                        var pnl = new ExtMVC.view.acgroups.AcgroupGrid({modal:true, closable:true});
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                    }
                                }
                            },{
                                text: Ext.lang.mainmenu.acsetup.accountsetup.menuTitle[Ext.lang.global.langId],
                                iconCls: 'icon-organization',
                                itemId: 'm2_2',
                                listeners: {
                                     click: function() {
                                        var pnl = new ExtMVC.view.acmaster.Grid({modal:true, closable:true});
                                        var l = new MyLib();
                                        l.openTab(pnl);
                                        pnl.down('toolbar').items.items[0].focus(false,200);
                                    }
                                } 
                            }]
                        }
                    }]
                }]
            }]
        },{
            flex:5,
            xtype:'tabpanel',
            itemId:'contentPanel',
            margin:'0 0 0 5',
            items:[{
                xtype:"panel",
                title:"Dashboard",
                style:'background-color:#71829C',
                layout:{
                    type:'hbox',
                    align:'stretch'
                },
                items:[{
                    flex:1.5,
                    xtype:'panel',
                    //title:'Organization',
                    itemId:'organization',
                    //margin:'0 0 0 5',
                    height:500,
                    layout:{
                        type:'vbox',
                        align:'stretch'
                    },
                    items:[{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'image',
                            //src:'resources/images/logo.png',
                            height:80,
                            width:80
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdTitle',
                            text:''
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdOrgName',
                            style:'font-family:Arial Narrow;font-size:20; font-weight:bolder'
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdOrgAddress'
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdTelephoneNo'
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdEmail'
                        }]
                    },{
                        xtype:'container',
                        layout:{
                            type:'hbox',
                            align:'middle',
                            pack:'center'
                        },
                        items:[{
                            xtype:'label',
                            itemId:'regdNo'
                        }]
                    }]
                },{
                    width:250,
                    height:500,
                    xtype:'container',
                    itemId:'current',
                    //margin:'10 10 10 5',
                    layout:{
                        type:'vbox',
                        align:'stretch'
                    },
                    items:[{
                        xtype:'panel',
                        //flex:1,
                        title:Ext.lang.global.user[Ext.lang.global.langId],
                        itemId:'currentUser',
                        bodyPadding:10,
                        layout:{
                            type:'vbox',
                            align:'stretch'
                        },
                        items:[{
                            xtype:'container',
                            layout:{
                                type:'hbox',
                                align:'stretch'
                            },
                            items:[{
                                xtype:'label',
                                text:Ext.lang.login.user[Ext.lang.global.langId],
                                style:'font-weight:bold; width:80'
                            },{
                                xtype:'label',
                                itemId:'cur_user'
                            }]
                        },{
                            xtype:'container',
                            layout:{
                                type:'hbox',
                                align:'stretch'
                            },
                            items:[{
                                xtype:'label',
                                text:Ext.lang.global.address[Ext.lang.global.langId],
                                style:'font-weight:bold; width:80'
                            },{
                                xtype:'label',
                                itemId:'cur_address'
                            }]
                        },{
                            xtype:'container',
                            layout:{
                                type:'hbox',
                                align:'stretch'
                            },
                            items:[{
                                xtype:'label',
                                text:Ext.lang.global.role[Ext.lang.global.langId],
                                style:'font-weight:bold; width:80'
                            },{
                                xtype:'label',
                                itemId:'cur_role'
                            }]
                        }]
                    },{
                        xtype:'panel',
                        title:"Voucher",
                        itemId:'vouchers',
                        flex:1,
                        height:500,
                        bodyPadding:10,
                        items:[{
                            xtype:'panel',
                            border:0,
                            layout:{
                                type:'vbox',
                                align:'stretch'
                            },
                            frame:false,
                            items:[{
                                xtype:'container',
                                border:0,
                                layout:{
                                    type:'hbox',
                                    align:'stretch'
                                },
                                border:0,
                                items:[{
                                    xtype:'label',
                                    text:'Journal Voucher',
                                    flex:1  
                                },{
                                    xtype:'label',
                                    itemId:'no_of_journal',
                                    text:'0',
                                    flex:1    
                                }]                                
                            },{
                                xtype:'container',
                                border:0,
                                layout:{
                                    type:'hbox',
                                    align:'stretch'
                                },
                                items:[{
                                    xtype:'label',
                                    text:'Receipt Voucher',                                    
                                    flex:1    
                                },{
                                    xtype:'label',
                                    itemId:'no_of_receipt',
                                    text:'0',
                                    flex:1    
                                }]
                            },{
                                xtype:'container',
                                border:0,
                                layout:{
                                    type:'hbox',
                                    align:'stretch'
                                },
                                items:[{
                                    xtype:'label',
                                    text:'Payment Voucher',                                    
                                    flex:1    
                                },{
                                    xtype:'label',
                                    itemId:'no_of_payment',
                                    text:'0',
                                    flex:1    
                                }]
                            }]
                        }] 
                    },{
                        xtype   :'tbfill'
                    },{
                        xtype:'panel',
                        title:'Developed By',
                        bodyPadding:10,
                        layout  :{
                            type:'vbox'
                        },
                        items:[{
                            xtype   :'label',
                            text:'WebPay Pvt. Ltd.',
                            style:'font-family:century gothic; font-size:20; font-weight:bolder'
                        },{
                            xtype   :'label',
                            text:'Sankhamul Marg, Kathmandu'
                        },{
                            xtype   :'label',
                            text:'Branch Office: Lahan'
                        },{
                            xtype   :'label',
                            text:'Contact No: 033-562522'
                        },{
                            xtype   :'label',
                            text:'Mobile No: 9841201980'
                        },{
                            xtype   :'label',
                            text:'Website: www.webpay.com.np'
                        },{
                            xtype   :'label',
                            text:'Email: mail@webpay.com.np'
                        },{
                            xtype   :'container',
                            html:"<div><a href='https://facebook.com.np/webpay'><img src='resources/images/login.png'  alt='WebPay'></a></div>"
                        }]

                    }]
                
                }]
            }]
        
        }]
    },{
        xtype:'container',
        padding:'2 0 0 0',
        height:25,
        style:'background-color:#000',
        layout:{
            type:'hbox',
            align:'middle',
            valign:'center'
        },
        items:[{
            xtype:'label',
            padding:'0 0 0 220',
            style:'color:#fff',
            text:'WebPay Pvt. Ltd., Sankhamul Marg, Kathmandu, Branch Office: Lahan, Contact No: 033-562522, Mobile: 9841201980'
        }]
      
    }]
})