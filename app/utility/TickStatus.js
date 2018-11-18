Ext.define('ExtMVC.utility.TickStatus', {
    extend: 'Ext.grid.column.Boolean',
    alias: 'widget.tickstatus',
    xtype: 'tickstatus',
    renderer: function(value, metaData, record, rowindx, colindx, store) {
        var out=null;
        if((value==true)||(value==1)){
            out ="<img alt='+' src='resources/images/tick.png'/>";
        }else{
            out ="<img alt='-' src='resources/images/untick.png'/>";
        }
        return out
    },
     dataIndex: 'status'
    //width: 80
});