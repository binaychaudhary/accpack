Ext.define('ExtMVC.store.Users', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.User',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Users/Create.php', 
            read: 'api/Users/list.php',
            update: 'api/Users/update.php',
            destroy: 'api/Users/delete.php'
        },
        reader: {
            type: 'json',
            root: 'users',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'users'
        } 
    }
});