Ext.define('ExtMVC.model.invitemrate', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'itemId',
        'sales_rate',
        'effective_date_bs',
        'effective_date_ad',
        "discount_rate",
        "sales_rate_type_id",
        'item_name'
    ]
});