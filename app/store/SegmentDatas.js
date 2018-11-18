Ext.define('ExtMVC.store.SegmentDatas', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.SegmentData',
    autoLoad: true,
    pageSize: 99999999999,
    autoLoad: {start: 0, limit: 99999999999},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/segdata/criaSegment.php', 
            read: 'api/segdata/listaSegments.php',
            update: 'api/segdata/atualizaSegment.php',
            destroy: 'api/segdata/deletaSegment.php'
        },
        reader: {
            type: 'json',
            root: 'segmentdatas',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'segmentdatas'
        }
    }
});