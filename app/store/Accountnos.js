Ext.define('ExtMVC.store.Accountnos', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Accountno',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Account/Create.php', 
            read: 'api/Account/list.php',
            update: 'api/Account/update.php',
            destroy: 'api/Account/delete.php'
        },
        reader: {
            type: 'json',
            root: 'accountnos',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'accountnos'
        } 
    }
});