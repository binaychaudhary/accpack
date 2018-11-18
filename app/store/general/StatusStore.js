Ext.define('ExtMVC.store.general.StatusStore', {
   extend: 'Ext.data.Store',
    alias: 'store.statusStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.both[Ext.lang.global.langId],
        "value": ""
    }, {
        "name": Ext.lang.global.active[Ext.lang.global.langId],
        "value": "1"
    }, {
        "name": Ext.lang.global.passive[Ext.lang.global.langId],
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});