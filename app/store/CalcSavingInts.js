Ext.define('ExtMVC.store.CalcSavingInts', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.CalcSavingInt',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/CalcSavingInt/list.php'
        },
        reader: {
            type: 'json',
            root: 'intcalcrecord',
            successProperty: 'success'
        }
    }
});