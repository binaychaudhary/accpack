Ext.define('ExtMVC.store.Savingintrates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Savingintrate',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/SavingIntRate/create.php', 
            read: 'api/SavingIntRate/list.php',
            update: 'api/SavingIntRate/update.php',
            destroy: 'api/SavingIntRate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'savingintrates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'savingintrates'
        } 
    }
});