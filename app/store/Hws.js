Ext.define('ExtMVC.store.Hws', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.hw',
    autoLoad: true,
    pageSize: 15,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/hw/list.php'
        },
        reader: {
            type: 'json',
            root: 'hws',
            successProperty: 'success'
        } 
    }
});