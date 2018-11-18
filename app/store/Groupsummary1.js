Ext.define('ExtMVC.store.Groupsummary1', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Groupsummary',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/reports/groupsummary.php'
        },
        reader: {
            type: 'json',
            root: 'groupsummary',
            successProperty: 'success'
        } 
    }
});