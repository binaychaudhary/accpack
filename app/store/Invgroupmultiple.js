Ext.define('ExtMVC.store.Invgroupmultiple', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invgroup',
    alias: 'store.Invgroupmultiple',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/invgroup/list.php'
        },
        reader: {
            type: 'json',
            root: 'invgroupmulti',
            successProperty: 'success'
        }
    }
});