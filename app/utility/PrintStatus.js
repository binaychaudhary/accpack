Ext.define('ExtMVC.utility.PrintStatus', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.printstatus',
    xtype: 'printstatus',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.cha;
        } else {
            return Ext.lang.global.chaina;
        }
    },
     dataIndex: 'printStatus'
    //width: 80
});