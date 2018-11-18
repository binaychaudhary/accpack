Ext.define('ExtMVC.store.Rooms', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Room',
    //alias: 'store.RoomsStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Room/Create.php', 
            read: 'api/Room/list.php',
            update: 'api/Room/update.php',
            destroy: 'api/Room/delete.php'
        },
        reader: {
            type: 'json',
            root: 'rooms',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'rooms'
        } 
    }
});