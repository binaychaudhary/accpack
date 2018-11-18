Ext.define('ExtMVC.store.Creditposts', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Creditpost',
    alias: 'store.creditpostStore',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	//create: 'api/Sanchalaksamiti/Create.php', 
            read: 'api/Creditpost/list.php'
            //update: 'api/Sanchalaksamiti/update.php',
            //destroy: 'api/Sanchalaksamiti/delete.php',
        },
        reader: {
            type: 'json',
            root: 'creditposts',
            successProperty: 'success'
        }
        // writer: {
        //     type: 'json',
        //     writeAllFields: true,
        //     encode: true,
        //     root: 'sanchalaks'
        // } 
    }
});