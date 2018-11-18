Ext.define('ExtMVC.store.ItemGroups', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.ItemGroup',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/ItemGroup/create.php', 
            read: 'api/ItemGroup/list.php',
            update: 'api/ItemGroup/update.php',
            destroy: 'api/ItemGroup/delete.php'
        },
        reader: {
            type: 'json',
            root: 'itemgroups',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'itemgroups'
        } 
    }
});