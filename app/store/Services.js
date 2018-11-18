Ext.define('ExtMVC.store.Services', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Service',
    //alias: 'store.BedsStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Service/Create.php', 
            read: 'api/Service/list.php',
            update: 'api/Service/update.php',
            destroy: 'api/Service/delete.php'
        },
        reader: {
            type: 'json',
            root: 'services',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'services'
        } 
    }
});