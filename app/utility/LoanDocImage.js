Ext.define('ExtMVC.utility.LoanDocImage', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.loandocimage',
    xtype: 'checkedunchecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        var out=null;
        if((value==true)||(value==1)){
            out ="<img style='width:100%; height:100%;' alt='+' src='"+value+"'/>";
        }else{
            out ="<img style='width:100%; height:100%;' alt='-' src='"+value+"'/>";
        }
        return out
    },
     dataIndex: 'url'
});