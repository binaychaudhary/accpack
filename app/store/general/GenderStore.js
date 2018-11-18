Ext.define('ExtMVC.store.general.GenderStore', {
   extend: 'Ext.data.Store',
    alias: 'store.genderStore',
    fields: ['name', 'value'],
    data: [{
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