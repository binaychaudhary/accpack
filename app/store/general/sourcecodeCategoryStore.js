Ext.define('ExtMVC.store.general.sourcecodeCategoryStore', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Category',
    alias: 'store.sourcecodeCategoryStore',
    autoLoad: true,
    pageSize: 15,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Sourcecode/categoryList.php'
        },
        reader: {
            type: 'json',
            root: 'category'
        }
    }
});