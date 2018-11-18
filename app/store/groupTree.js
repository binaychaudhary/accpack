Ext.define('ExtMVC.store.groupTree', {
    extend: 'Ext.data.TreeStore',
    alias: 'store.groupTree',
    storeId: 'groupTree',
    model: 'ExtMVC.model.ItemGroupTree',
    autoLoad: true,
    requires:[
        'Ext.tree.*',
        'Ext.data.*',
        'Ext.tip.*'
    ],
    proxy: {
        type: 'ajax',
        url : 'api/ItemGroup/ItemGroups.php',
        reader: {
            type: 'json',
            root: 'itemgroups'
        }
    },
    
    folderSort: true,
    sorters: [{
        property: 'group_name',
        direction: 'ASC'
    }]
});