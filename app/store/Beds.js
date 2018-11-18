Ext.define('ExtMVC.store.Beds', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Bed',
    autoLoad: true,
    //autoLoad:{bdescription:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Bed/Create.php', 
            read: 'api/Bed/list.php?bdescription=',
            update: 'api/Bed/update.php',
            destroy: 'api/Bed/delete.php'
        },
        reader: {
            type: 'json',
            root: 'beds',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'beds'
        } 
    }
});