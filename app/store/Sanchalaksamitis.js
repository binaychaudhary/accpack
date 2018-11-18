Ext.define('ExtMVC.store.Sanchalaksamitis', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sanchalaksamiti',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Sanchalaksamitis/Create.php', 
            read: 'api/Sanchalaksamitis/list.php',
            update: 'api/Sanchalaksamitis/update.php',
            destroy: 'api/Sanchalaksamitis/delete.php'
        },
        reader: {
            type: 'json',
            root: 'sanchalaksamitis',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'sanchalaksamitis'
        } 
    }
});