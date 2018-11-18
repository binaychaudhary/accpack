Ext.define('ExtMVC.store.Arrivals', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Arrival',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Arrival/Create.php', 
            read: 'api/Arrival/list.php',
            update: 'api/Arrival/update.php',
            destroy: 'api/Arrival/delete.php'
        },
        reader: {
            type: 'json',
            root: 'arrivals',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'arrivals'
        } 
    }
});