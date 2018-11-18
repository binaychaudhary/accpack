Ext.define('ExtMVC.model.Chequeprint', {
    extend: 'Ext.data.Model',
    fields: ['id','accountNo','startNo', 'endNo','noofLeaf', 'printedDateBs', 'printedDateAd','printedBy','accountDesc','userName']
});