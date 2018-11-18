Ext.define('ExtMVC.utility.CheckedUnchecked', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.checkedunchecked',
    xtype: 'checkedunchecked',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        var out=null;
        if((value==true)||(value==1)){
            out ="<img alt='+' src='resources/images/tick.png'/>";
        }else{
            out ="<img alt='-' src='resources/images/untick.png'/>";
        }
        return out
    },
     dataIndex: 'choice'
});