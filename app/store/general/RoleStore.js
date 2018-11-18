Ext.define('ExtMVC.store.general.RoleStore', {
extend: 'Ext.data.Store',
model: 'ExtMVC.model.Role',
alias: 'store.roleStore',
//autoLoad: true,
autoLoad: {start: 0, limit: 99999999999 },
proxy : {
    type : 'ajax',
    actionMethods : 'POST',
    api : {
        read : 'api/Roles/listaRoles.php'
    },
    reader: {
        type: 'json',
        root: 'roles'
    }
}
});