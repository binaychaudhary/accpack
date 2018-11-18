Ext.define('ExtMVC.store.LoanPaymentType', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.LoanPaymentType',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/LoanPaymentType/list.php'
        },
        reader: {
            type: 'json',
            root: 'loanpaymenttype',
            successProperty: 'success'
        }
    }
});