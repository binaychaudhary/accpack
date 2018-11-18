Ext.define('ExtMVC.store.CashCreditStore', {
   extend: 'Ext.data.Store',
    alias: 'store.cashcreditStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.cash,
        "value": "1"
    }, {
        "name": Ext.lang.global.Credit,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});