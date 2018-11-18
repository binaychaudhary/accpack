Ext.define('ExtMVC.store.LoanIntRates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.LoanIntRate',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/LoanIntRate/create.php', 
            read: 'api/LoanIntRate/list.php',
            update: 'api/LoanIntRate/update.php',
            destroy: 'api/LoanIntRate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'loanintrates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'loanintrates'
        } 
    }
});