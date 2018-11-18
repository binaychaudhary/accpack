Ext.define('ExtMVC.store.Loandoc', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.loan_doc',
    alias: 'store.loandoc',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/LoanDoc/create.php', 
            read: 'api/LoanDoc/list.php',
            update: 'api/LoanDoc/update.php',
            destroy: 'api/LoanDoc/delete.php'
        },
        reader: {
            type: 'json',
            root: 'loandoc',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'loandoc'
        } 
    }
});