Ext.define('ExtMVC.view.segment.TranOpener', {
    extend: 'Ext.window.Window',
    alias : 'widget.tranopenerform',
    itemId:'tranopenerform',
    title:Ext.lang.mainmenu.master.tranopener.menuTitle[Ext.lang.global.langId],
    layout: 'fit',    
    autoShow: true,
    width:300,
    //controller:'tranopenercontroller',
    requires:[
        'ExtMVC.dateConverter.DateHelper'
    ],
    iconCls: 'icon-user',
    items:[{
        xtype:'form',
        items:[{
            xtype:'container',
            //00layout:'vbox',
            padding:10,
            align:'center',
            allowBlank:false,
            items:[{
                xtype:'textfield',
                labelWidth:120,
                fieldLabel:Ext.lang.mainmenu.master.tranopener.openDate[Ext.lang.global.langId],
                itemId:'openDate',
                name:'openDate',
                componentCls:'nepaliNumber',
                fieldStyle:'text-align:left',
                maskRe: /[0-9.]/,
                maxWidth:10,
                blankText:'YYYY/MM/DD'
            }]
        }]  
    }]
    ,
     dockedItems: [{
        dock: 'bottom',
        ui: 'footer',
        xtype: 'container',
        layout: {
            type: 'hbox',
            align: 'middle',
            pack: 'center'
        },
        items: [
        {
            xtype: 'button',
            itemId:'btnOpenDate',
            text: Ext.lang.mainmenu.master.tranopener.openButton[Ext.lang.global.langId],
            action:'login',
            padding:5,
            listeners:{
                'click': function(){
                    var w = this.up().up();
                    f = w.down('form');
                    var dtBs = f.query('#openDate')[0];
                    if(dtBs.value.length==10){
                        var hp =new DateHelper();
                        var dtAd =Ext.Date.parse(hp.ConvertBsToAd(dtBs.value),"Y/m/d");
                        var fyStarAd=Ext.state.Manager.get("fyearStartDtAd");
                        var fyEndAd=Ext.state.Manager.get("fyearEndDtAd");          
                        
                    
                        if(dtAd>=fyStarAd && dtAd<=fyEndAd){
                            Ext.state.Manager.set("currTranDateAd",dtAd);
                            Ext.state.Manager.set("currTranDateBs",dtBs.value);
                            //inserting in transaction date
                            Ext.Ajax.request({
                                waitMsg: 'Searching...', 
                                method: 'POST',
                                async:false,
                                url: 'api/TranDate/openTranDate.php',
                                params: {
                                        fiscalYear:Ext.state.Manager.get("curfYear"),
                                        tranDateBs:dtBs.value,
                                        tranDateAd:dtAd
                                },
                                scope:this,
                                success: function(response){
                                    var gData = Ext.JSON.decode(response.responseText);
                                    var mnu=Ext.ComponentQuery.query('#westMenu')[0];
                                    mnu.collapse(true);
                                   
                                    if(gData.success){
                                         mnu.setDisabled(false);
                                    }else{
                                         mnu.setDisabled(true);
                                    }
                                    var w = Ext.ComponentQuery.query('#tranopenerform')[0];
                                    w.close();
                                    var lg=new ExtMVC.view.Login({modal:true});
                                    lg.show();
                                }
                            });
                        }else{
                            Ext.Msg.show({
                                title : Ext.lang.mainmenu.master.tranopener.invalidDateRange[Ext.lang.global.langId],
                                msg : Ext.lang.mainmenu.master.tranopener.invalidDateRangeMsg[Ext.lang.global.langId],
                                width : 350,
                                closable : false,
                                buttons : Ext.Msg.OK,
                                buttonText : 
                                {
                                    ok : Ext.lang.global.ok
                                },
                                multiline : false,
                                icon : Ext.Msg.INFORMATION
                            });
                        }
                    }
                }
            }
        }]
    }]
});