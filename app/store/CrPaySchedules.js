Ext.define('ExtMVC.store.CrPaySchedules', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.CrPaySchedule',
    autoLoad: true,
    // pageSize: 15,
    // autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/CrPaySchedule/Create.php', 
            read: 'api/CrPaySchedule/list.php',
            update: 'api/CrPaySchedule/update.php',
            destroy: 'api/CrPaySchedule/delete.php'
        },
        reader: {
            type: 'json',
            root: 'crpayschedules',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'crpayschedules'
        } 
    }
});