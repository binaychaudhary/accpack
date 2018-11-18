Ext.define('ExtMVC.store.Sharedetails', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sharedetail',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Sharedetail/create.php', 
            read: 'api/Sharedetail/list.php',
            update: 'api/Sharedetail/update.php',
            destroy: 'api/Sharedetail/delete.php'
        },
        reader: {
            type: 'json',
            root: 'sharedetails',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'sharedetails'
        } 
    }
});