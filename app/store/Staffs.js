Ext.define('ExtMVC.store.Staffs', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Staff',
    alias: 'store.staffsStore',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Staff/Create.php', 
            read: 'api/Staff/list.php',
            update: 'api/Staff/update.php',
            destroy: 'api/Staff/delete.php'
        },
        reader: {
            type: 'json',
            root: 'staffs',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'staffs'
        } 
    }
});