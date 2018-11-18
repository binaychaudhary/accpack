Ext.define('ExtMVC.utility.StatusChecked', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.statuschecked',
    xtype: 'statuschecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.active[Ext.lang.global.langId];
        } else {
            return Ext.lang.global.passive[Ext.lang.global.langId];
        }
    },
     dataIndex: 'status'
});