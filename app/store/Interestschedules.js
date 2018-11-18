Ext.define('ExtMVC.store.Interestschedules', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Interestschedule',
    alias: 'store.interestschedules',
    autoLoad: true,
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Interestschedule/create.php', 
            read: 'api/Interestschedule/list.php',
            update: 'api/Interestschedule/update.php',
            destroy: 'api/Interestschedule/delete.php'
        },
        reader: {
            type: 'json',
            root: 'interestschedules',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'interestschedules'
        } 
    }
});