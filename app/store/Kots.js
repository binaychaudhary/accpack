Ext.define('ExtMVC.store.Kots', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.kot',
    autoLoad: true,
    autoLoad:{user_id:null,table_id:null,status:null
    },
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/kot/create.php', 
            read: 'api/kot/list.php',
            update: 'api/kot/update.php',
            destroy: 'api/kot/delete.php'
        },
        reader: {
            type: 'json',
            root: 'kots',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'kots'
        } 
    }
});