Ext.define('ExtMVC.utility.TopupChecked', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.topupchecked',
    xtype: 'topupchecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.yes;
        } else {
            return Ext.lang.global.no;
        }
    },
     dataIndex: 'use_topup'
});