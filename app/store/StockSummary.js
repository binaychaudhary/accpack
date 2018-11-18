Ext.define('ExtMVC.store.StockSummary', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.StockSummary',
    alias: 'store.stocksummary',
    proxy: {
        type: 'memory'
    }
});