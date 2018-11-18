Ext.define('ExtMVC.store.Ledger', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Ledger',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/reports/Ledger.php'
        },
        reader: {
            type: 'json',
            root: 'Ledger',
            successProperty: 'success'
        } 
    }
});