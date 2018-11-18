Ext.define('ExtMVC.store.interesttype', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.InterestType',
    alias: 'store.interesttype',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/InterestType/list.php'
        },        
        reader: {
            type: 'json',
            root: 'interesttype',
            successProperty: 'success'
        }
    }
});