Ext.define('ExtMVC.store.Segments', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Segment',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999, foo:   'bar'},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/Seg/criaSegment.php', 
            read: 'api/Seg/listaSegments.php',
            update: 'api/Seg/atualizaSegment.php',
            destroy: 'api/Seg/deletaSegment.php'
        },
        reader: {
            type: 'json',
            root: 'segments',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'segments'
        } 
    }
});