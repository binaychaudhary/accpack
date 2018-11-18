Ext.define('ExtMVC.model.LoanIntRate', {
    extend: 'Ext.data.Model',
    fields: ['id','subGroupId', 'matureTypeId', 'effectedDateBs', 'effectedDateAd','rate','subGroupDesc','matureType','subGroupCode']
});