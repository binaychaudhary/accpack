Ext.define('ExtMVC.model.SalesDayBook', {
    extend: 'Ext.data.Model',
    fields: ['entry_date_bs', 'entryNo','customer', 'amount', 'vat', 'gross','address','sales_amt']
});