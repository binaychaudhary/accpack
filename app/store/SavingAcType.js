Ext.define('ExtMVC.store.SavingAcType', {
   extend: 'Ext.data.Store',
    alias: 'store.savingactype',
    fields: ['name', 'value'],
    data: [{
        "name": "Saving A/C",
        "value": "1"
    }, {
        "name": "Fixed Deposit A/C",
        "value": "2"
    }, {
        "name": "Current A/C",
        "value": "3"
    }],
    proxy: {
        type: 'memory'
    }
});