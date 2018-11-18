Ext.define('ExtMVC.store.kagjatname', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.kagjatname',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/kagjatname/list.php'
        },
        reader: {
            type: 'json',
            root: 'kagjatname',
            successProperty: 'success'
        }
    }
});