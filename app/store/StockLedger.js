Ext.define('ExtMVC.store.StockLedger', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.StockLedger',
    alias: 'store.stockledger',
    proxy: {
        type: 'memory'
    }
});