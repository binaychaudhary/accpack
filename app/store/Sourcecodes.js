Ext.define('ExtMVC.store.Sourcecodes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Sourcecode',
    autoLoad: true,    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Sourcecode/create.php', 
            read: 'api/Sourcecode/list.php',
            update: 'api/Sourcecode/update.php',
            destroy: 'api/Sourcecode/delete.php'
        },
        reader: {
            type: 'json',
            root: 'sourcecodes',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'sourcecodes'
        } 
    }
});