Ext.define('ExtMVC.model.MenuRoot', {
extend: 'Ext.data.Model',

uses: [
'ExtMVC.model.MenuItem'
],

idProperty: 'id',

fields: [
{
name: 'title'
},
{
name: 'iconCls'
},
{
name: 'id'
}
],

hasMany: {
model: 'ExtMVC.model.MenuItem',
foreignKey: 'menu_id',
name: 'items'
}
});