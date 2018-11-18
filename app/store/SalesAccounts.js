Ext.define('ExtMVC.store.SalesAccounts', {
    extend: 'Ext.data.Store',
    fields:['accountNo', 'accountDesc'],
    alias: 'store.SalesAccounts',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Account/SalesAccounts.php'
        },
        reader: {
            type: 'json',
            root: 'accounts'
        }
    }
});