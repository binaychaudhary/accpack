Ext.define('ExtMVC.store.general.Language', {
   extend: 'Ext.data.Store',
    alias: 'store.languageStore',
    fields: ['name', 'value'],
    data: [{
        "name": "English",
        "value": "0"
    }, {
        "name": "Nepali",
        "value": "1"
    }],
    proxy: {
        type: 'memory'
    }
});