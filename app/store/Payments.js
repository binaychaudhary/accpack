Ext.define('ExtMVC.store.Payments', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Payment',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad:{fiscalYear: null, sourceCodeId: null},
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Payment/list.php'
        },
        reader: {
            type: 'json',
            root: 'payments',
            successProperty: 'success'
        }
    }
});