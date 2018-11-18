Ext.define('ExtMVC.store.Invitems', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.InvItem',
    alias: 'store.invitems',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/invitem/create.php', 
            read: 'api/invitem/list.php',
            update: 'api/invitem/update.php',
            destroy: 'api/invitem/delete.php'
        },
        reader: {
            type: 'json',
            root: 'invitems',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'invitems'
        } 
    }
});