Ext.define('ExtMVC.store.Acgrouplist', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.acgroup',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {group_name:null, parent_group_id:null, ac_nature:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/acgroup/acgrouplist.php'
        },
        reader: {
            type: 'json',
            root: 'acgrouplist',
            successProperty: 'success'
        }
    }
});