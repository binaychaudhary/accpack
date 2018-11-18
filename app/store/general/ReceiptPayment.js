Ext.define('ExtMVC.store.general.ReceiptPayment', {
   extend: 'Ext.data.Store',
    alias: 'store.receiptpaymentpagesize',
    fields: ['name', 'value'],
    data: [{
        "name": 'A4 Portrait',
        "value": "20"
    }, {
        "name": 'A4 Landscape',
        "value": "12"
    }],
    proxy: {
        type: 'memory'
    }
});