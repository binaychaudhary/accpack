Ext.define('ExtMVC.view.segment.TranCloser', {
    extend: 'Ext.window.Window',
    alias : 'widget.trancloserform',
    itemId:'trancloserform',
    title:'Close Date',
    layout: 'fit',    
    autoShow: true,
    width:300,
    //controller:'tranopenercontroller',
    requires:[
        'ExtMVC.dateConverter.DateHelper',
        'ExtMVC.view.Login'
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
                fieldLabel:'Closing Date',
                itemId:'closeDate',
                name:'closeDate',
                componentCls:'nepaliNumber',
                fieldStyle:'text-align:left',
                maskRe: /[0-9/]/,
                maxWidth:10,
                blankText:'YYYY/MM/DD'
            }]
        }]  
    }],
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
            itemId:'btnCloseDate',
            text: 'बन्द गर्नुहोस',
            action:'close',
            padding:5,
            listeners:{
                'click': function(){
                    var w = this.up().up();
                    f = w.down('form');
                    var dtBs = f.query('#closeDate')[0].value;
                     if(dtBs.length==10){
                        Ext.Ajax.request({
                            waitMsg: 'Searching...', 
                            method: 'POST',
                            url: 'api/TranDate/closeTranDate.php',
                            params: {
                                    tranDateBs:dtBs
                            },
                            scope:this,
                            success: function(resp){
                                var resData = Ext.JSON.decode(resp.responseText);
                                if(resData.success){
                                    Ext.MessageBox.alert('Date Closed.');
                                    
                                    var w = Ext.ComponentQuery.query('#trancloserform')[0]
                                    w.close()

                                    var l = new ExtMVC.view.Login({modal:true});
                                    l.show();
                                }
                            }
                        }); 
                     }
                 }
            }
        }]
    }]
});