Ext.define('ExtMVC.store.Sharepurchases', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sharepurchase',
    autoLoad: true,
    pageSize: 10000000,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Share/Create.php', 
            read: 'api/Share/list.php',
            update: 'api/Share/update.php',
            destroy: 'api/Share/delete.php'
        },
        reader: {
            type: 'json',
            root: 'sharepurchases',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'sharepurchases'
        } 
    }
});