Ext.define('ExtMVC.store.monthlybilling', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.monthlybilling',
    autoLoad: true,
    //autoLoad:{bdescription:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/monthlybilling/create.php', 
            read: 'api/monthlybilling/list.php'
        },
        reader: {
            type: 'json',
            root: 'monthlybilling',
            successProperty: 'success'
        }
        // writer: {
        //     type: 'json',
        //     writeAllFields: true,
        //     encode: true,
        //     root: 'monthlybilling'
        // } 
    }
});