Ext.define('ExtMVC.model.MenuItem', {
extend: 'Ext.data.Model',

uses: [
'ExtMVC.model.MenuRoot'
],

idProperty: 'id',

fields: [
{
name: 'text'
},
{
name: 'iconCls'
},
{
name: 'className'
},
{
name: 'id'
},
{
name: 'menu_id'
}
],

belongsTo: {
model: 'ExtMVC.model.MenuRoot',
foreignKey: 'menu_id'
}
});