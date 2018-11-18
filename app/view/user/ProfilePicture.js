Ext.define('ExtMVC.view.user.ProfilePicture', {
    extend: 'Ext.window.Window',
    alias : 'widget.profilepicture',
    itemId:'profilepicture',
    
    title:'Profile Picture',
    layout: 'fit',    
    autoShow: true,
    width:500,
    
    iconCls: 'icon-user',
    items : [
    {
        xtype: 'form',    
        border: false,
        layout:{
            type:'vbox',
            align:'stretch'
        },        
        items:[{
            xtype:'container',
            padding:10,
            layout:{
                type:'vbox',
                align:'stretch'
            },
            items: [
            {
                xtype:'textfield',
                itemId:'id',
                name:'id',
                hidden:true
            },{
                xtype: 'textfield',
                name : 'username',
                fieldLabel: 'User Name',
                itemId:'username'   ,
                readOnly:true
            },{
                xtype:'image',
                itemId:'img',
                name:'img',
                width:120,
                height:130,
                src:null
            //    padding:'15 0 0 0'
            },{
                xtype:'container',
                layout:{
                    type:'hbox',
                    align:'stretch'
                },
                items:[{
                    xtype: 'fileuploadfield',
                    id: 'form-file',
                    emptyText: 'Select image',
                    name: 'image-upload',
                    buttonText: 'Browse'
                },{
                    xtype:'button',
                    text:'Upload',
                    handler:function(){
                        var form = this.up('form').getForm();
                        form.submit({
                            url:'includes/uploaduserimage.php',
                            waitMst:'Uploading....',
                            success:function(fp,o){
                                var res = Ext.JSON.decode(o.response.responseText); 
                                var fileName = res.filename;
                                var img = form.items[0].items[2];
                                img.Src=fileName;    
                                var l= new MyLib();
                                l.showMessage('Successfully Uploaded File '+ o.result.file+' on the server',Ext.Msg.INFO);
                             
                            }
                        });
                    }
                }]             
            }]

        },{
            dockedItems: [{
                dock: 'bottom',
                ui: 'footer',
                xtype: 'toolbar',
                layout: {
                    type: 'hbox',
                    align: 'middle',
                    pack: 'center'
                },
                items: [
                    {
                        xtype: 'button',
                        iconCls: 'icon-close',
                        text: Ext.lang.global.close,
                        action:'close',
                        handler:function(buttons,e){
                            var x= buttons.up('window');
                            x.close();
                        }
                    }
                ]
            }]
        }]
    }]
});