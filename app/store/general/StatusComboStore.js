Ext.define('ExtMVC.store.general.StatusComboStore', {
   extend: 'Ext.data.Store',
    alias: 'store.statuscomboStore',
    fields: ['name', 'value'],
    data: [{
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