Ext.define('ExtMVC.store.Trialbalances', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Trialbalance',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 9999999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/reports/trbls.php'
        },
        reader: {
            type: 'json',
            root: 'trialbalances',
            successProperty: 'success'
        }
    }
});