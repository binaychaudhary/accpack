Ext.define('ExtMVC.store.GenderStore', {
   extend: 'Ext.data.Store',
    alias: 'store.genderstore',
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