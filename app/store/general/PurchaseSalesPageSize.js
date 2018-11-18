Ext.define('ExtMVC.store.general.PurchaseSalesPageSize', {
   extend: 'Ext.data.Store',
    alias: 'store.purchasesalespagesize',
    fields: ['name', 'value'],
    data: [{
        "name": 'A4 Portrait',
        "value": "29"
    }, {
        "name": 'A4 Landscape',
        "value": "14"
    }],
    proxy: {
        type: 'memory'
    }
});