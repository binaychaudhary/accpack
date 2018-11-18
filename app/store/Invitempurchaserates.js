Ext.define('ExtMVC.store.Invitempurchaserates', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.invitempurchaserate',
    alias: 'store.invitempurchaserates',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/InvItemPurchaseRate/create.php', 
            read: 'api/InvItemPurchaseRate/list.php',
            update: 'api/InvItemPurchaseRate/update.php',
            destroy: 'api/InvItemPurchaseRate/delete.php'
        },
        reader: {
            type: 'json',
            root: 'invitempurchaserates',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'invitempurchaserates'
        } 
    }
});