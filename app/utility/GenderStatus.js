Ext.define('ExtMVC.utility.GenderStatus', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.genderstatus',
    xtype: 'genderstatus',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.male;
        } else {
            return Ext.lang.global.female;
        }
    },
     dataIndex: 'gender'
});