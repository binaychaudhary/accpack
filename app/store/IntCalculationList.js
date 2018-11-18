Ext.define('ExtMVC.store.IntCalculationList', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.IntCalculationList',
    alias: 'store.intcalculationlist',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/IntCalculationList/list.php'
        },        
        reader: {
            type: 'json',
            root: 'intcalculationlist',
            successProperty: 'success'
        }
    }
});