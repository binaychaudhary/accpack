Ext.define('ExtMVC.view.segment.TranOpenerController', {
    extend: 'Ext.app.Controller',
    alias:'widget.tranopenercontroller',
    
    //models: ['Accategory'],

    views: [
        'segment.TranOpener'
    ],

    init: function() {
        this.control({
            'tranopenerform': {
                beforerender: this.editar
            }
        });
    },
    loadCurrentDate:function(){
        var dt  = new Date();
        var w = Ext.ComponentQuery.query('#tranopenerform')[0];
        var dtBs = w.query('#openDate')[0];
        dtBs.setValue(dt);
    },
    onSearchFailure: function(err){
            Ext.MessageBox.alert('Status', 'Error occured during searching...');
    }  
});