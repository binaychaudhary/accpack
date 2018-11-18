Ext.define('ExtMVC.store.general.CollectorStore', {
extend: 'Ext.data.Store',
model: 'ExtMVC.model.Collector',
alias: 'store.collectorStore',
//autoLoad: true,
autoLoad: true,
proxy : {
    type : 'ajax',
    actionMethods : 'GET',
    api : {
        read : 'api/Staff/collectorList.php'
    },
    reader: {
        type: 'json',
        root: 'staffs'
    }
}
});