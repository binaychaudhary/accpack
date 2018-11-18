Ext.define('ExtMVC.store.consumerconnectionhistry', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.ConsumerConnectionHistry',
    autoLoad: true,
    //autoLoad:{bdescription:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/consumer_connection_histry/create.php', 
            read: 'api/consumer_connection_histry/list.php',
            update: 'api/consumer_connection_histry/update.php',
            destroy: 'api/consumer_connection_histry/delete.php'
        },
        reader: {
            type: 'json',
            root: 'consumerconnectionhistry',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'consumerconnectionhistry'
        } 
    }
});