Ext.define('ExtMVC.store.general.Acnature', {
extend: 'Ext.data.Store',
fields:['id','nature'],
alias: 'store.Acnature',
//autoLoad: true,
autoLoad: {start: 0, limit: 99999999999 },
proxy : {
    type : 'ajax',
    actionMethods : 'POST',
    api : {
        read : 'api/Group/acnatureList.php'
    },
    reader: {
        type: 'json',
        root: 'natures'
    }
}
});