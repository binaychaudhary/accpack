Ext.define('ExtMVC.store.Submenus', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Submenu',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Submenu/list.php'
        },
        reader: {
            type: 'json',
            root: 'submenus',
            successProperty: 'success'
        } 
    }
});