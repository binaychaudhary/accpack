Ext.define('ExtMVC.store.SalesDayBooks', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.SalesDayBook',
    autoLoad: true,
    //pageSize: 15,
    //autoLoad: {start: 0, limit: 99999999999},
    
    // proxy: {
    //     type: 'ajax',
    //     api: {
    //         read: 'api/SalesDayBook/list.php',
    //     },
    //     reader: {
    //         type: 'json',
    //         root: 'salesdaybooks',
    //         successProperty: 'success'
    //     }
        
    // }
    proxy: {
        type: 'memory'
    }
});