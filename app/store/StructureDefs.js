Ext.define('ExtMVC.store.StructureDefs', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.StructureDef',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/StructureDef/Create.php', 
            read: 'api/StructureDef/list.php',
            update: 'api/StructureDef/update.php',
            destroy: 'api/StructureDef/delete.php'
        },
        reader: {
            type: 'json',
            root: 'structuredefs',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'structuredefs'
        } 
    }
});