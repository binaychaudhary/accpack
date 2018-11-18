Ext.define('ExtMVC.store.invGroupTree', {
    extend: 'Ext.data.TreeStore',
    alias: 'store.invGroupTree',
    storeId: 'invGroupTree',
    model: 'ExtMVC.model.invGroupModel',
    autoLoad: true,
    requires:[
        'Ext.tree.*',
        'Ext.data.*',
        'Ext.tip.*'
    ],

    proxy: {
        type: 'ajax',
        ajax: 'api/ItemGroup/ItemGroups.php'
    },
    root: {
        text: 'Groups',
        id: 'itemgroups',
        expanded: true
    },
    folderSort: true,
    sorters: [{
        property: 'group_name',
        direction: 'ASC'
    }]
});