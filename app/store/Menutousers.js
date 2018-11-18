Ext.define('ExtMVC.store.Menutousers', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.menutouser',
    autoLoad: true,
   // pageSize: 15,
    autoLoad: {userId:null, mainMenuId:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Menutousers/create.php', 
            read: 'api/Menutousers/list.php',
            update: 'api/Menutousers/update.php',
            destroy: 'api/Menutousers/delete.php'
        },
        reader: {
            type: 'json',
            root: 'menutousers',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'menutousers'
        } 
    }
});