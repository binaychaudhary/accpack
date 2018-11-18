Ext.define('ExtMVC.store.sales', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sales',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/sales/list.php?fiscaYear=&sourceCodeId=4&entryNo='
        },
        reader: {
            type: 'json',
            root: 'sales',
            successProperty: 'success'
        }
    }
});