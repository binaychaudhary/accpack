Ext.define('ExtMVC.model.Payment', {
    extend: 'Ext.data.Model',
    fields: ['id','fiscalyear', 'sourceCodeId', 'entryNo', 'entry_date_bs' ,'entry_date_ad', 'accountNo','debit','credit','collectorId','narration', 'accountDesc', 'userId', 'groupCode','subGroupCode','natureId','account','groupDesc']
});