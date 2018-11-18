Ext.define('ExtMVC.store.Receipts', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Receipt',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad:{fiscalYear: null, sourceCodeId: null},
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Receipt/list.php'
        },
        reader: {
            type: 'json',
            root: 'receipts',
            successProperty: 'success'
        }
    }
});