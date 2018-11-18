Ext.define('ExtMVC.store.Subgroups', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Subgroup',
    alias: 'store.subgroups',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Group/Subgroup/Create.php', 
            read: 'api/Group/Subgroup/list.php',
            update: 'api/Group/Subgroup/update.php',
            destroy: 'api/Group/Subgroup/delete.php'
        },
        reader: {
            type: 'json',
            root: 'subgroups',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'subgroups'
        } 
    }
});