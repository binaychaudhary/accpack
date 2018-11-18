Ext.define('ExtMVC.store.Purchaseorderdetails', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.PurchaseOrderDetail',
    autoLoad: true,
    autoLoad:{order_id:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Purchaseorderdetails/create.php', 
            read: 'api/Purchaseorderdetails/list.php',
            update: 'api/Purchaseorderdetails/update.php',
            destroy: 'api/Purchaseorderdetails/delete.php'
        },
        reader: {
            type: 'json',
            root: 'purchaseorderdetails',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'purchaseorderdetails'
        } 
    }
});