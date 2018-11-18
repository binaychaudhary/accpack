Ext.define('ExtMVC.store.Struccodes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Struccode',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/StructureCode/list.php'
        },
        reader: {
            type: 'json',
            root: 'structurecodes',
            successProperty: 'success'
        } 
    }
});