Ext.define('ExtMVC.store.Vouchers', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Voucher',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Voucher/create.php', 
            read: 'api/Voucher/list.php',
            update: 'api/Voucher/update.php',
            destroy: 'api/Voucher/delete.php'
        },
        reader: {
            type: 'json',
            root: 'journals',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'journals'
        } 
    }
});