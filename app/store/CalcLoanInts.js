Ext.define('ExtMVC.store.CalcLoanInts', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.CalcLoanInt',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/CalcLoanInt/list.php'
        },
        reader: {
            type: 'json',
            root: 'loanintcalcrecord',
            successProperty: 'success'
        }
    }
});