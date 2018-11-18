Ext.define('ExtMVC.store.GroupSavingIntRates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.GroupSavingIntRate',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/GroupSavingIntRate/create.php', 
            read: 'api/GroupSavingIntRate/list.php',
            update: 'api/GroupSavingIntRate/update.php',
            destroy: 'api/GroupSavingIntRate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'groupsavingintrates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'groupsavingintrates'
        } 
    }
});