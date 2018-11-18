Ext.define('ExtMVC.utility.TransferChecked', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.transferchecked',
    xtype: 'transferchecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.yes;
        } else {
            return Ext.lang.global.no;
        }
    },
     dataIndex: 'use_fund_transfer'
});