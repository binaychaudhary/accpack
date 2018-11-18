Ext.define('ExtMVC.store.Menu', {
extend: 'Ext.data.Store',

requires: [
'ExtMVC.model.MenuRoot'
],

constructor: function(cfg) {
var me = this;
cfg = cfg || {};
me.callParent([Ext.apply({
storeId: 'MenuStore',
model: 'ExtMVC.model.MenuRoot',
proxy: {
type: 'ajax',
url: 'api/menu.json',
reader: {
type: 'json',
root: 'items'
}
}
}, cfg)]);
}
});