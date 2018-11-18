
Ext.define('ExtMVC.store.Purchaseorders', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Purchaseorder',
    autoLoad: true,
    autoLoad:{ordered_to:null, is_email_sent:null, status:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/purchaseorder/create.php', 
            read: 'api/purchaseorder/list.php?',
            update: 'api/purchaseorder/update.php',
            destroy: 'api/purchaseorder/delete.php'
        },
        reader: {
            type: 'json',
            root: 'purchaseorders',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'purchaseorders'
        } 
    }
});