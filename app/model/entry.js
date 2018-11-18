Ext.define('ExtMVC.model.entry',{
	extend: 'Ext.data.Model',
	fields:['id','fiscalyear','userId','sourceCodeId','entryNo','amount','entry_date_bs','entry_date_ad','approvalStatus','approvedBy','approvedDate','sourceCode','printStatus','printedBy','printedDate']
});