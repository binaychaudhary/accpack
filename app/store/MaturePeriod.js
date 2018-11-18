Ext.define('ExtMVC.store.MaturePeriod', {
extend: 'Ext.data.Store',
model: 'ExtMVC.model.MaturePeriod',
alias: 'store.matureperiod',
//autoLoad: true,
autoLoad: {start: 0, limit: 99999999999 },
proxy : {
    type : 'ajax',
    actionMethods : 'POST',
    api : {
        read : 'api/MaturePeriod/list.php'
    },
    reader: {
        type: 'json',
        root: 'matureperiod'
    }
}
});