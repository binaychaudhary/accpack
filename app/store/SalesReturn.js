Ext.define('ExtMVC.store.SalesReturn', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.SalesReturn',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/SalesReturn/list.php?fiscaYear=&sourceCodeId=4&entryNo='
        },
        reader: {
            type: 'json',
            root: 'salesreturn',
            successProperty: 'success'
        }
    }
});