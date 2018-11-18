Ext.define('ExtMVC.store.general.MaritalStore', {
   extend: 'Ext.data.Store',
    alias: 'store.maritalStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.married,
        "value": "1"
    }, {
        "name": Ext.lang.global.unmarried,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});