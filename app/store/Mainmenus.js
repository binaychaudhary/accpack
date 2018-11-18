Ext.define('ExtMVC.store.Mainmenus', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Mainmenu',
    autoLoad: true,
    pageSize: 15,
   // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Mainmenu/list.php'            
        },
        reader: {
            type: 'json',
            root: 'mainmenus',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'mainmenus'
        } 
    }
});