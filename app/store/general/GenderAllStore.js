Ext.define('ExtMVC.store.general.GenderAllStore', {
   extend: 'Ext.data.Store',
    alias: 'store.genderAllStore',
    fields: ['name', 'value'],
    data: [{
        "name": 'All',
        "value": ""
    },{
        "name": Ext.lang.global.male,
        "value": "1"
    }, {
        "name": Ext.lang.global.female,
        "value": "0"
    }],
    proxy: {
        type: 'memory'
    }
});