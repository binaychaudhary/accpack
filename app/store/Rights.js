Ext.define('ExtMVC.store.Rights', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Right',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Roles/rights/CreateRight.php', 
            read: 'api/Roles/rights/listaRight.php',
            update: 'api/Roles/rights/updateRight.php',
            destroy: 'api/Roles/rights/deleteRight.php'
        },
        reader: {
            type: 'json',
            root: 'rights',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'rights'
        } 
    }
});