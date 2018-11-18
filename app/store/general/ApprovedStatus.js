Ext.define('ExtMVC.store.general.ApprovedStatus', {
   extend: 'Ext.data.Store',
    alias: 'store.approvedStatus',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.global.cha,
        "value": "1"
    }, {
        "name": Ext.lang.global.chaina,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});