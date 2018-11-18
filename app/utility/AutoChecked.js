Ext.define('ExtMVC.utility.AutoChecked', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.autochecked',
    xtype: 'autochecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.yes;
        } else {
            return Ext.lang.global.no;
        }
    },
     dataIndex: 'Auto'
    //width: 80
});