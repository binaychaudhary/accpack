Ext.define('ExtMVC.store.Accategorys', {
    extend: 'Ext.data.Store',
    model: 'billing.model.Accategory',
    alias: 'store.accategorys',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Accategory/create.php', 
            read: 'api/Accategory/list.php',
            update: 'api/Accategory/update.php',
            destroy: 'api/Accategory/delete.php'
        },
        reader: {
            type: 'json',
            root: 'accategorys',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'accategorys'
        } 
    }
});