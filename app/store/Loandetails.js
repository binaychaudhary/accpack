Ext.define('ExtMVC.store.Loandetails', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.loan_detail',
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/LoanDetail/create.php', 
            read: 'api/LoanDetail/list.php',
            update: 'api/LoanDetail/update.php',
            destroy: 'api/LoanDetail/delete.php'
        },
        reader: {
            type: 'json',
            root: 'loandetails',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'loandetails'
        } 
    }
});