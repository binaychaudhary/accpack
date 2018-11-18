Ext.define('ExtMVC.store.Mahina', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Mahina',
    autoLoad: true,
    pageSize: 15,
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/mahina/mahina.php'
        },
        reader: {
            type: 'json',
            root: 'mahina',
            successProperty: 'success'
        } 
    }
});