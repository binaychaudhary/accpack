Ext.define('ExtMVC.store.Schedules', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Schedule',
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Schedule/list.php'       
        },
        reader: {
            type: 'json',
            root: 'schedules',
            successProperty: 'success'
        } 
    }
});