Ext.define('ExtMVC.store.general.StatusStore', {
   extend: 'Ext.data.Store',
    alias: 'store.statusStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.both,
        "value": ""
    }, {
        "name": Ext.lang.global.active,
        "value": "1"
    }, {
        "name": Ext.lang.global.passive,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});