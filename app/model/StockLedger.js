Ext.define('ExtMVC.model.StockLedger', {
    extend: 'Ext.data.Model',
    fields: [
        'date_bs',
        'description',
        'entryNo',
        'unit',
        'purchase_qty',
        'purchase_amount',        
        'sales_qty',
        'sales_amount',
        'balance_qty',
        'balance_amount'
    ]
});