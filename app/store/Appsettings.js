Ext.define('ExtMVC.store.Appsettings', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.appsetting',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/appsetting/create.php', 
            read: 'api/appsetting/list.php',
            update: 'api/appsetting/update.php',
            destroy: 'api/appsetting/delete.php'
        },
        reader: {
            type: 'json',
            root: 'appsettings',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'appsettings'
        } 
    }
});