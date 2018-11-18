Ext.define('ExtMVC.store.Balancesheets', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Balancesheet',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/Balancesheet/list.php'
        },
        reader: {
            type: 'json',
            root: 'balancesheets',
            successProperty: 'success'
        }
    }
});