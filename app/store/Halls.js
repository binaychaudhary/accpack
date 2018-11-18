Ext.define('ExtMVC.store.Halls', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Hall',
    //alias: 'store.HallsStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Hall/Create.php', 
            read: 'api/Hall/list.php',
            update: 'api/Hall/update.php',
            destroy: 'api/Hall/delete.php'
        },
        reader: {
            type: 'json',
            root: 'halls',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'halls'
        } 
    }
});