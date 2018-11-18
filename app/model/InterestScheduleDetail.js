Ext.define('ExtMVC.model.Interestscheduledetail', {
    extend: 'Ext.data.Model',
    fields: ['id','accountNo','loan_detail_id','loan_amount','payment_date_bs','payment_date_ad','remaining_principle','loan_installment','interest_amount','total_installment','payment_status']
});