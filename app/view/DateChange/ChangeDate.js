Ext.define('ExtMVC.view.DateChange.ChangeDate' ,{
    extend: 'Ext.window.Window',
    alias : 'widget.changedate',
    itemId:'changedate',
    title: 'Temprory Date Change',
    modal:true,
    //width:900,
    items:[{
        xtype: 'form',
        dock: 'top',
        collapsible: true,
        titleCollapse: true,
        //title: Ext.lang.global.searchTitle,
        //iconCls: 'icon-grid',
        
        items:[{
            xtype:'container',
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            padding:10,
            border:false,
            items: [
            {
                xtype: 'textfield',
                itemId: 'dt_bs',
                name: 'dt_bs',
                labelWidth:70,
                fieldLabel: 'Date (BS)',
                allowBlank:false,
                emptyText:'YYYY/MM/DD',
                maskRe:/[0-9/]/
            }]
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
        items: [{
            xtype: 'button',
            //iconCls: 'icon-close',
            text: 'Change Date',
            padding:3,
            action:'close',
            handler:function(buttons,e){
                var w = buttons.up('window'),
                f = w.down('form');
                var dtbs = f.query('#dt_bs') [0].getValue();
                var l = new DateHelper();
                var dtad = l.ConvertBsToAd(dtbs);
                Ext.state.Manager.set("currTranDateAd",dtad);
                Ext.state.Manager.set("currTranDateBs",dtbs);
                buttons.up('window').close();
                var currDate=Ext.ComponentQuery.query('#currDate')[0];

                currDate.setText(Ext.lang.global.dt+" : "+dtbs);
            }
        }]
   }]     
});
