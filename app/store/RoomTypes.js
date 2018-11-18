Ext.define('ExtMVC.store.RoomTypes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.RoomType',
    //alias: 'store.RoomTypesStore',
    autoLoad: true,
    // pageSize: 99999999999,
    
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/RoomType/Create.php', 
            read: 'api/RoomType/list.php?rdescription=',
            update: 'api/RoomType/update.php',
            destroy: 'api/RoomType/delete.php'
        },
        reader: {
            type: 'json',
            root: 'roomtypes',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'roomtypes'
        } 
    }
});