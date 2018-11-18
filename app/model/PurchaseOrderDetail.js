Ext.define('ExtMVC.model.PurchaseOrderDetail', {
    extend: 'Ext.data.Model',
    fields: ['id', 'order_id','item_id','unit_id','qty','rate','amount','user_id','item_name','unit']
});