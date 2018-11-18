Ext.define('ExtMVC.store.PipelineMeterStatus', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.PipelineMeterStatus',
    autoLoad: true,
    //autoLoad:{bdescription:null},
    proxy: {
        type: 'ajax',
        api: {
        	create: 'api/pipeline_meter_status/create.php', 
            read: 'api/pipeline_meter_status/list.php?status_name=',
            update: 'api/pipeline_meter_status/update.php',
            destroy: 'api/pipeline_meter_status/delete.php'
        },
        reader: {
            type: 'json',
            root: 'pipelinemeterstatus',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'pipelinemeterstatus'
        } 
    }
});