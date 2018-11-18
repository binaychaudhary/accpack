Ext.define('ExtMVC.store.Waiters', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Staff',
    alias: 'store.waitersStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
            read: 'api/Staff/waiterlist.php?status=&designationId=6'
        },
        reader: {
            type: 'json',
            root: 'staffs',
            successProperty: 'success'
        }
    }
});