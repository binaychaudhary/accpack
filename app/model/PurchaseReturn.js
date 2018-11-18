Ext.define('ExtMVC.model.PurchaseReturn', {
    extend: 'Ext.data.Model',
    fields: [
    'id', 
    'itemId',
    'aliasName',
    'itemName',
    'rate',
    'qty',
    'unitId',
    'unitName',
    'amount',
    'alias_name',
    'sales_to',
    'discount_rate',
    'discount_amount',
    'net_amount',
    'ref_no',
    'ref_date',
    'sales_order_no'
    ]
});