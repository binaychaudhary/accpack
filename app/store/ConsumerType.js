Ext.define('ExtMVC.store.ConsumerType', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.ConsumerType',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/consumertype/list.php'            
        },
        reader: {
            type: 'json',
            root: 'consumertype',
            successProperty: 'success'
        }
    }
});