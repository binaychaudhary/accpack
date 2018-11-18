Ext.define('ExtMVC.store.Groups', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Group',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Group/Create.php', 
            read: 'api/Group/list.php',
            update: 'api/Group/update.php',
            destroy: 'api/Group/delete.php'
        },
        reader: {
            type: 'json',
            root: 'groups',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'groups'
        } 
    }
});