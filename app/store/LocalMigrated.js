Ext.define('ExtMVC.store.LocalMigrated', {
   extend: 'Ext.data.Store',
    alias: 'store.LocalMigrated',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.consumer.local,
        "value": "1"
    }, {
        "name": Ext.lang.consumer.migrated,
        "value": "2"
    }],
    proxy: {
        type: 'memory'
    }
});