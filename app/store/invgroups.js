Ext.define('ExtMVC.store.invgroups', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invgroup',
    alias: 'store.invgroups',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/invgroup/create.php', 
            read: 'api/invgroup/list.php',
            update: 'api/invgroup/update.php',
            destroy: 'api/invgroup/delete.php'
        },
        reader: {
            type: 'json',
            root: 'invgroups',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'invgroups'
        } 
    }
});