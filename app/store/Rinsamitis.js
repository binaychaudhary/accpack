Ext.define('ExtMVC.store.Rinsamitis', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Rinsamiti',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Rinsamitis/Create.php', 
            read: 'api/Rinsamitis/list.php',
            update: 'api/Rinsamitis/update.php',
            destroy: 'api/Rinsamitis/delete.php'
        },
        reader: {
            type: 'json',
            root: 'rinsamitis',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'rinsamitis'
        } 
    }
});