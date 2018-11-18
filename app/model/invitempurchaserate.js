Ext.define('ExtMVC.model.invitempurchaserate', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'itemId',
        'purchase_rate',
        'effective_date_bs',
        'effective_date_ad',
        "discount_rate",
        'item_name'
    ]
});