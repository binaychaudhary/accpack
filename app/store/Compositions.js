Ext.define('ExtMVC.store.Compositions', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.composition',
    autoLoad: true,
    pageSize: 20,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Composition/create.php', 
            read: 'api/Composition/list.php',
            update: 'api/Composition/update.php',
            destroy: 'api/Composition/delete.php'
        },
        reader: {
            type: 'json',
            root: 'compositions',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'compositions'
        } 
    }
});