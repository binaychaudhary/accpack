Ext.define('ExtMVC.store.PurchaseAccounts', {
    extend: 'Ext.data.Store',
    fields:['accountNo', 'accountDesc'],
    alias: 'store.PurchaseAccounts',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Account/PurchaseAccounts.php'
        },
        reader: {
            type: 'json',
            root: 'accounts'
        }
    }
});