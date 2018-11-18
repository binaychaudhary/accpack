Ext.define('ExtMVC.store.Departmentss', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Department',
    alias: 'store.departmentss',
    autoLoad: true,
    // pageSize: 99999999999,
     //autoLoad: {vdescription:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Department/departmentCreate.php', 
            read: 'api/Department/departmentlist.php?department=',
            update: 'api/Department/departmentupdate.php',
            destroy: 'api/Department/departmentdelete.php'
        },
        reader: {
            type: 'json',
            root: 'departmentss',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'departmentss'
        } 
    }
});