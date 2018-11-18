Ext.define('ExtMVC.model.CrPaySchedule',{
	extend: 'Ext.data.Model',
	fields:['id','loan_amount','no_of_installment',
	'interest_type','installment_period','installment_start_date_bs',
	'installment_start_date_ad','interest_rate']
});