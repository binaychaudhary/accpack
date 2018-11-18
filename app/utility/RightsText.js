Ext.define('ExtMVC.utility.RightsText', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.rightstext',
    xtype: 'rightstext',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.rights.view;
        } else if (value == 2) {
            return Ext.lang.rights.add;
        } else if (value == 3) {
            return Ext.lang.rights.edit;
        } else if (value == 4) {
            return Ext.lang.rights.delete;
        } else if (value == 5) {
            return Ext.lang.rights.print;
        } else if (value == 6) {
            return Ext.lang.rights.userMgmt;
        }
    },
     dataIndex: 'rightId'
    //width: 80
});