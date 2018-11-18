Ext.define('ExtMVC.store.BillPayments', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.BillPayment',
    autoLoad: true,
    //autoLoad:{bdescription:null},
    proxy: {
        type: 'ajax',
        api: {
        	//create: 'api/Lodge/Create.php', 
            read: 'api/Lodge/billPayment.php?bill_id='
            //update: 'api/Bed/update.php',
            //destroy: 'api/Bed/delete.php',
        },
        reader: {
            type: 'json',
            root: 'billpayments',
            successProperty: 'success'
        }
        // ,
        // writer: {
        //     type: 'json',
        //     writeAllFields: true,
        //     encode: true,
        //     root: 'beds'
        // } 
    }
});