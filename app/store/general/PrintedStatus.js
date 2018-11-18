Ext.define('ExtMVC.store.general.PrintedStatus', {
   extend: 'Ext.data.Store',
    alias: 'store.printedStatus',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.cha,
        "value": "1"
    }, {
        "name": Ext.lang.global.chaina,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});