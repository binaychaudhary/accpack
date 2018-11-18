Ext.define('ExtMVC.utility.ApprovalStatus', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.approvalstatus',
    xtype: 'approvalstatus',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return Ext.lang.global.cha;
        } else {
            return Ext.lang.global.chaina;
        }
    },
     dataIndex: 'approvalStatus'
    //width: 80
});