Ext.define('ExtMVC.store.Fiscalyears', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Fiscalyear',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/fiscalyear/create.php', 
            read: 'api/fiscalyear/list.php',
            update: 'api/fiscalyear/update.php',
            destroy: 'api/fiscalyear/delete.php'
        },
        reader: {
            type: 'json',
            root: 'fiscalyears',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'fiscalyears'
        } 
    }
});