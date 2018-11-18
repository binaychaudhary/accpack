Ext.define('ExtMVC.store.Roles', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Role',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Roles/CreateRole.php', 
            read: 'api/Roles/listaRoles.php',
            update: 'api/Roles/updateRole.php',
            destroy: 'api/Roles/deleteRole.php'
        },
        reader: {
            type: 'json',
            root: 'roles',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'roles'
        } 
    }
});