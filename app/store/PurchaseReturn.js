Ext.define('ExtMVC.store.PurchaseReturn', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.PurchaseReturn',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/PurchaseReturn/list.php?fiscaYear=&sourceCodeId=4&entryNo='
        },
        reader: {
            type: 'json',
            root: 'purchasereturn',
            successProperty: 'success'
        }
    }
});