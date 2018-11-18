Ext.define('ExtMVC.model.Kitchenorder', {
    extend: 'Ext.data.Model',
    fields: ['id','locationId','itemId','qty','rate','unit','amount','entry_date_bs','status','location_name','alias_name','itemName','waiter_id','no_of_pax','waiter_name','is_kot_printed','kot_id']
});