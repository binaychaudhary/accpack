Ext.define('ExtMVC.utility.eBanking', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.ebanking',
    xtype: 'ebanking',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.yes;
        } else if(value==0) {
            return Ext.lang.global.no;
        }else{
            return null;
        }
    },
     dataIndex: 'ebanking'
    //width: 80
});