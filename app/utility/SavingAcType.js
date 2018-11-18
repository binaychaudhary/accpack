Ext.define('ExtMVC.utility.SavingAcType', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.savingactype',
    xtype: 'savingactype',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        if (value == 1) {
            return "Saving A/C";
        } else if(value==2) {
            return "Fixed Deposit A/C";
        } else if(value==3){
            return "Current A/C";
        }else{
            return null;
        }
    },
     dataIndex: 'accountTypeId'
    //width: 80
});