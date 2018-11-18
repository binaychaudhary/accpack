Ext.define('ExtMVC.store.RoomRates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.RoomRate',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/RoomRate/Create.php', 
            read: 'api/RoomRate/list.php?room_id=&effective_date_bs=',
            update: 'api/RoomRate/update.php',
            destroy: 'api/RoomRate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'roomrates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'roomrates'
        } 
    }
});