Ext.define('ExtMVC.store.Chequeprints', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Chequeprint',
    autoLoad: true,
    pageSize: 20,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Chequeprint/create.php', 
            read: 'api/Chequeprint/list.php',
            update: 'api/Chequeprint/update.php',
            destroy: 'api/Chequeprint/delete.php'
        },
        reader: {
            type: 'json',
            root: 'chequeprints',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'chequeprints'
        } 
    }
});