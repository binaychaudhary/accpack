Ext.define('ExtMVC.store.Sourcecategorys', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sourcecategory',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/SourceCategory/create.php', 
            read: 'api/SourceCategory/list.php',
            update: 'api/SourceCategory/update.php',
            destroy: 'api/SourceCategory/delete.php'
        },
        reader: {
            type: 'json',
            root: 'sourcecategorys',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'sourcecategorys'
        }
    }
});