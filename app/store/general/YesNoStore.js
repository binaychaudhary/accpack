Ext.define('ExtMVC.store.general.YesNoStore', {
   extend: 'Ext.data.Store',
    alias: 'store.yesnoStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.yes,
        "value": "1"
    }, {
        "name": Ext.lang.global.no,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});