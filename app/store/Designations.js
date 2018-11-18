Ext.define('ExtMVC.store.Designations', {
    extend: 'Ext.data.Store',
    fields:['id', 'designation'],
    alias: 'store.Designations',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Staff/designationList.php'
        },
        reader: {
            type: 'json',
            root: 'designation'
        }
    }
});