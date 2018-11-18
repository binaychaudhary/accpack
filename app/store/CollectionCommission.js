Ext.define('ExtMVC.store.CollectionCommission', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.DailyCollection',
    alias: 'store.collectioncommission',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/CollectorComm/CollectionDetail.php'
        },        
        reader: {
            type: 'json',
            root: 'collectiondetail',
            successProperty: 'success'
        }
    }
});