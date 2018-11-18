Ext.define('ExtMVC.model.LoanCollateral', {
    extend: 'Ext.data.Model',
    fields: ['id','loan_id', 'accountNo', 'agreedAmount','status','accountDesc','acNo']
});