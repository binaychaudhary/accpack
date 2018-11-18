Ext.define('ExtMVC.store.Kitchenorders', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Kitchenorder',
    autoLoad: true,
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Kitchenorder/create.php', 
            read: 'api/Kitchenorder/list.php?entry_date_bs=null&locationI=null&status=1',
            update: 'api/Kitchenorder/update.php',
            destroy: 'api/Kitchenorder/delete.php'
        },
        reader: {
            type: 'json',
            root: 'kitchenorders',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'kitchenorders'
        } 
    }
});