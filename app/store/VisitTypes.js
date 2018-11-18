Ext.define('ExtMVC.store.VisitTypes', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.VisitType',
    //alias: 'store.RoomTypesStore',
    autoLoad: true,
    // pageSize: 99999999999,
    // autoLoad: {vdescription:null},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/VisitType/visitcreate.php', 
            read: 'api/VisitType/visitlist.php?vdescription=',
            update: 'api/VisitType/visitupdate.php',
            destroy: 'api/VisitType/visitdelete.php'
        },
        reader: {
            type: 'json',
            root: 'visittypes',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'visittypes'
        } 
    }
});