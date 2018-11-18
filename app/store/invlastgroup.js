Ext.define('ExtMVC.store.invlastgroup', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invgroup',
    alias: 'store.invlastgroup',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/invgroup/grouplist.php'
        },
        reader: {
            type: 'json',
            root: 'invlastgroup',
            successProperty: 'success'
        }
    }
});