Ext.define('ExtMVC.store.Orgs', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Org',
    
    pageSize: 15,
    //autoLoad: {start: 0, limit: 99999999999},
    //  proxy: {
    //     type: 'directFn',
    //     directFn: "QueryDatabase.getResults"
    // },
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Org/create.php', 
            read: 'api/Org/list.php',
            update: 'api/Org/update.php',
            destroy: 'api/Org/delete.php'
        },
        reader: {
            type: 'json',
            rootProperty: 'orgs',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            rootProperty: 'orgs'
        } 
    }
});