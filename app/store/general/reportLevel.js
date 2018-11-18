Ext.define('ExtMVC.store.general.reportLevel', {
   extend: 'Ext.data.Store',
    alias: 'store.reportlevel',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.akshar.n2,
        "value": "2"
    }, {
        "name": Ext.lang.akshar.n3,
        "value": "3"
    }],
    proxy: {
        type: 'memory'
    }
});