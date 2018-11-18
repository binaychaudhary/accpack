Ext.define('ExtMVC.store.Entries', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.entry',
    autoLoad: true,
   // pageSize: 15,
    autoLoad: {fiscalyear:null, sourceCodeId:1,entryNo:null,approvalStatus:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Entry/create.php', 
            read: 'api/Entry/list.php',
            update: 'api/Entry/update.php',
            destroy: 'api/Entry/delete.php'
        },
        reader: {
            type: 'json',
            root: 'entries',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'entries'
        } 
    }
});