Ext.define('ExtMVC.model.monthlybilling', {
    extend: 'Ext.data.Model',
    fields: ['id','fiscalyear', 'yr','mn','entry_date_bs','entry_date_ad','prv_reading','cur_reading','unit','rate_id','amount','consumer_id','consumer_name','meter_id','meter_no','accountNo','sourceCodeId','entryNo']
});