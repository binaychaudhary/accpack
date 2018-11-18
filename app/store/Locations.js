Ext.define('ExtMVC.store.Locations', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Location',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            create: 'api/Location/create.php', 
            read: 'api/Location/list.php',
            update: 'api/Location/update.php',
            destroy: 'api/Location/delete.php'
        },
        reader: {
            type: 'json',
            root: 'locations',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'locations'
        } 
    }
});