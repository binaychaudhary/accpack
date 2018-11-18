Ext.define('ExtMVC.store.Sanchalaks', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sanchalak',
    alias: 'store.sanchalakStore',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	//create: 'api/Sanchalaksamiti/Create.php', 
            read: 'api/Sanchalak/list.php'
            //update: 'api/Sanchalaksamiti/update.php',
            //destroy: 'api/Sanchalaksamiti/delete.php',
        },
        reader: {
            type: 'json',
            root: 'sanchalak',
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