Ext.define('ExtMVC.model.purchase', {
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
    'purchase_from',
    'discount_rate',
    'discount_amount',
    'net_amount',
    'ref_no',
    'ref_date',
    'purchase_order_no'
    ]
});