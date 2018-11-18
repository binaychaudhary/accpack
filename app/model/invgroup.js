Ext.define('ExtMVC.model.invgroup', {
    extend: 'Ext.data.Model',
    fields: [
    'id', 
    'group_code', 
    'group_name', 
    'parent_group_id',
    'parent_group',
    'parent_group_name',
    'hasChild',
    'level',
    'count'
    ]
});