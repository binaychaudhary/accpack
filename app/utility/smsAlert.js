Ext.define('ExtMVC.utility.smsAlert', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.smsalert',
    xtype: 'smsalert',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.yes;
        } else if(value==0) {
            return Ext.lang.global.no;
        }else{
            return null;
        }
    },
     dataIndex: 'smsAlert'
    //width: 80
});