Ext.define('ExtMVC.store.Invitemrates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invitemrate',
    autoLoad: true,
    pageSize: 15,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Invitemrate/create.php', 
            read: 'api/Invitemrate/list.php',
            update: 'api/Invitemrate/update.php',
            destroy: 'api/Invitemrate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'invitemrates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'invitemrates'
        } 
    }
});