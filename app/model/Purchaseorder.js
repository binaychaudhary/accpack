Ext.define('ExtMVC.model.Purchaseorder', {
    extend: 'Ext.data.Model',
    fields: ['id', 'order_date_bs','order_date_ad','created_by','ordered_to','ordered_to_desc','email_address','is_email_sent','status']
});