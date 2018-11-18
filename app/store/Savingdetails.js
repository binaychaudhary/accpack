Ext.define('ExtMVC.store.Savingdetails', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Savingdetail',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Savingdetail/create.php', 
            read: 'api/Savingdetail/list.php',
            update: 'api/Savingdetail/update.php',
            destroy: 'api/Savingdetail/delete.php'
        },
        reader: {
            type: 'json',
            root: 'savingdetails',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'savingdetails'
        } 
    }
});