Ext.define('ExtMVC.store.Units', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Unit',
    alias: 'store.Units',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Unit/create.php', 
            read: 'api/Unit/list.php',
            update: 'api/Unit/update.php',
            destroy: 'api/Unit/delete.php'
        },
        reader: {
            type: 'json',
            root: 'units',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'units'
        } 
    }
});