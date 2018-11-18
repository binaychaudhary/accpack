Ext.define('ExtMVC.store.general.RightsStore', {
   extend: 'Ext.data.Store',
    alias: 'store.rightsStore',
    fields: ['name', 'value'],
    data: [{
        "name": Ext.lang.rights.all,
        "value": "0"
    },{
        "name": Ext.lang.rights.view,
        "value": "1"
    }, {
        "name": Ext.lang.rights.add,
        "value": "2"
    }, {
        "name": Ext.lang.rights.edit,
        "value": "3"
    }, {
        "name": Ext.lang.rights.delete,
        "value": "4"
    }, {
        "name": Ext.lang.rights.print,
        "value": "5"
    }, {
        "name": Ext.lang.rights.userMgmt,
        "value": "6"
    }],
    proxy: {
        type: 'memory'
    }
});