Ext.define('ExtMVC.store.StructureCodes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.StructureCode',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/StructureCode/Create.php', 
            read: 'api/StructureCode/list.php',
            update: 'api/StructureCode/update.php',
            destroy: 'api/StructureCode/delete.php'
        },
        reader: {
            type: 'json',
            root: 'structurecodes',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'structurecodes'
        } 
    }
});