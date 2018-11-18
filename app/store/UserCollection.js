Ext.define('ExtMVC.store.UserCollection', {
    extend: 'Ext.data.Store',
    model:'ExtMVC.model.UserCollection',
    autoLoad: true,

    
    proxy: {
        type: 'ajax',
        api: {
        	read: 'api/Entry/usersCollection.php?userId=&from_date_ad=&upto_date_ad='
        },
        reader: {
            type: 'json',
            root: 'collectionSummary',
            successProperty: 'success'
        }
        // writer: {
        //     type: 'json',
        //     writeAllFields: true,
        //     encode: true,
        //     root: 'accountnos'
        // } 
    }
});