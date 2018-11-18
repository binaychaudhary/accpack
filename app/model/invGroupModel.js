Ext.define('ExtMVC.model.invGroupModel', {
    extend: 'Ext.data.TreeModel',
    fields: [
        'id','group_code','group_name','hasChild','parent_group_id','level'
    ]
});