Ext.define('ExtMVC.store.collectorcomm', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.CollectorCommission',
    alias: 'store.collectorcomm',
    autoLoad: true,
    autoLoad:{mahinaId:-1},
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/CollectorComm/list.php'
        },        
        reader: {
            type: 'json',
            root: 'collectorcomm',
            successProperty: 'success'
        }
    }
});