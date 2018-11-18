Ext.define('ExtMVC.store.LoanCollaterals', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.LoanCollateral',
    alias: 'store.loancollaterals',
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/LoanCollateral/create.php', 
            read: 'api/LoanCollateral/list.php',
            update: 'api/LoanCollateral/update.php',
            destroy: 'api/LoanCollateral/delete.php'
        },
        reader: {
            type: 'json',
            root: 'loancollaterals',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'loancollaterals'
        } 
    }
});