Ext.define('ExtMVC.store.GetSubGroup', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Subgroup',
    alias: 'store.GetSubGroup',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Group/Subgroup/search.php?status=&groupId=20&subGroupCode=&subGroupName=&start=0&limit=9999999999'
        },
        reader: {
            type: 'json',
            root: 'GetSubGroup',
            successProperty: 'success'
        } 
    }
});