Ext.define('ExtMVC.store.Lodges', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Lodge',
    //alias: 'store.HallsStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Lodge/Create.php', 
            read: 'api/Lodge/list.php',
            update: 'api/Lodge/update.php',
            destroy: 'api/Lodge/delete.php'
        },
        reader: {
            type: 'json',
            root: 'lodges',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'lodges'
        } 
    }
});