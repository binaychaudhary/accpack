Ext.define('ExtMVC.model.StockSummary', {
    extend: 'Ext.data.Model',
    fields: ['id',
        'item_name',
        'alias_name',
        'group_id',
        'unit',
        'alya_qty',
        'alya_amount',        
        'purchase_qty',
        'purchase_amount',        
        'sales_qty',
        'sales_amount',
        'balance_qty',
        'balance_amount'
    ]
});