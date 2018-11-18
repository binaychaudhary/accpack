Ext.define('ExtMVC.store.purchases', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.purchase',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/purchase/list.php?fiscaYear=&sourceCodeId=4&entryNo='
        },
        reader: {
            type: 'json',
            root: 'purchases',
            successProperty: 'success'
        }
    }
});