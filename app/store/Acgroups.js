Ext.define('ExtMVC.store.Acgroups', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.acgroup',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {group_name:null, parent_group_id:null, ac_nature:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/acgroup/create.php', 
            read: 'api/acgroup/list.php',
            update: 'api/acgroup/update.php',
            destroy: 'api/acgroup/delete.php'
        },
        reader: {
            type: 'json',
            root: 'acgroups',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'acgroups'
        } 
    }
});