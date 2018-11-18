Ext.define('ExtMVC.store.invparentgroup', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invgroup',
    alias: 'store.invparentgroup',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/invgroup/listgroup.php'
        },
        reader: {
            type: 'json',
            root: 'invparentgroup',
            successProperty: 'success'
        }
    }
});