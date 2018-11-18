Ext.define('ExtMVC.store.Consumers', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Consumer',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/consumer/create.php', 
            read: 'api/consumer/list.php',
            update: 'api/consumer/update.php',
            destroy: 'api/consumer/delete.php'
        },
        reader: {
            type: 'json',
            root: 'consumers',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'consumers'
        } 
    }
});