Ext.define('ExtMVC.store.general.JournalPageSize', {
   extend: 'Ext.data.Store',
    alias: 'store.journalpagesize',
    fields: ['name', 'value'],
    data: [{
        "name": 'A4 Portrait',
        "value": "23"
    }, {
        "name": 'A4 Landscape',
        "value": "14"
    }],
    proxy: {
        type: 'memory'
    }
});