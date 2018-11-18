Ext.define('ExtMVC.store.GuestTypes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.GuestType',
    //alias: 'store.RoomTypesStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/GuestType/guestcreate.php', 
            read: 'api/GuestType/guestlist.php',
            update: 'api/GuestType/guestupdate.php',
            destroy: 'api/GuestType/guestdelete.php'
        },
        reader: {
            type: 'json',
            root: 'guesttypes',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'guesttypes'
        } 
    }
});