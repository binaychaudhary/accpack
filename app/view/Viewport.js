/**
 * The main application viewport, which displays the whole application
 * @extends Ext.Viewport
 */
Ext.define('ExtMVC.view.Viewport', {
    extend: 'Ext.Viewport',    
    layout: 'fit',
    
    requires: [
        'ExtMVC.view.Home',
        'ExtMVC.view.Login'
    ],
    
    initComponent: function() {
        var me = this;        
        Ext.apply(me, {
            items: [{
                xtype: 'homeform',
                itemId: 'homeform',
                hidden:true          
            },{
                xtype:'loginform',
                itemId:'loginform'
            }]
        });
                
        me.callParent(arguments);
    }
});