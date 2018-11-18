Ext.define('ExtMVC.store.CommissionRate', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.CommissionRate',
    alias: 'store.commissionrate',
    //autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/commission/create.php', 
            read: 'api/commission/list.php',
            update: 'api/commission/update.php',
            destroy: 'api/commission/delete.php'
        },
        reader: {
            type: 'json',
            root: 'commissionrate',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'commissionrate'
        } 
    }
});