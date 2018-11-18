Ext.define('ExtMVC.controller.Home', {
    extend: 'Ext.app.Controller',

    views: ['Home','Login'],
    
    init: function() {
        this.control({
            'homeform': {
                beforerender: this.loadOrgData  
             },
             'loginform': {
                afterrender: this.maintainContainerWidths  
             },
             '#dayCloser':{
                click: this.closeTrans
             },
             '#logout':{
                click: this.onlogOut
             },
             '#loginform button[action=login]':{
                click: this.doLogin
             },
             // '#loginform':{
             //    afterrender: this.resizePanel
             // },
             '#loginform button[action=reset]':{
                click: this.doReset
             }  
        });
    },

    maintainContainerWidths:function(v){
        v.query('#bottomContainer')[0].width= window.screen.availWidth;
        v.query('#topContainer')[0].width= window.screen.availWidth;
        v.query('#topContainer')[0].height =  window.screen.availHeight-450;
        var l = new MyLib();
        var dtHp = new DateHelper();
        var dt = Ext.Date.format(new Date(), 'Y-m-d');
        var currTranDateAd =dt;
        var currTranDateBs = dtHp.ConvertAdToBs(Ext.Date.parse(currTranDateAd,"Y-m-d"));
        
        v.query('#dtAd')[0].setText(currTranDateAd+' AD');
        var mn = currTranDateBs.substr(5,2);
        var yr = currTranDateBs.substr(0,4);
        var mnNp = l.getData('mahina','mahina','mahinaId',mn);
        var dt = currTranDateBs.substr(-2)+ ' ' + mnNp;
        v.query('#dt')[0].setText(dt);
        v.query('#yr')[0].setText(yr);

        var f = v.down('form');
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            async:false,
            url: 'api/Org/list.php',
            params: {
                    start:0,
                    limit:99999999999
            },
            scope:this,
            success: function(response){
                var gData = Ext.JSON.decode(response.responseText);        
                var orgName = f.query('#orgName')[0];
                var orgAddress = f.query('#orgAddress')[0];
                var orgContactNo = f.query('#orgContactNo')[0];
                var orgEmail = f.query('#orgEmail')[0];
                orgName.setText(gData.orgs[0].orgName);
                orgAddress.setText('Address: ' +gData.orgs[0].address);
                orgContactNo.setText('Contact No.: '+gData.orgs[0].telephoneNo);
                orgEmail.setText('Email Address : '+gData.orgs[0].email);
            }
        });

    },

    doReset:function(button){
        var w= button.up('window');
        f= w.down('form');
    },
    doLogin:function(button){
        //button.up('window').setLoading(true);
        lib = new MyLib();
        var currTranDateAd = null;                                            
        var currTranDateBs = "";
        f=button.up('form');
        var email=f.query('#txtEmail')[0].getValue();
        var pass = f.query('#txtPass')[0].getValue();
        var process=true;
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            async:false,
            url: 'api/Users/login.php',
            params: {
                    email:email,
                    pass:pass
            },
            scope:this,
            success: function(response){
                var gData = Ext.JSON.decode(response.responseText); 
                var count =  gData.total;
                
                if(count>0){
                    var status = gData.users[0].status;
                    if (status==1){                        
                        var userName = gData.users[0].userName;
                        var address =  gData.users[0].address;
                        var id =  gData.users[0].id;
                        var roleId =  gData.users[0].roleId;       
                        
                        var l= new MyLib();
                        

                        Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
                        Ext.state.Manager.set("uName",userName);
                        Ext.state.Manager.set("uAddress",address);
                        Ext.state.Manager.set("uId",id);
                        Ext.state.Manager.set("uRoleId",roleId);
                        var log_utility=Ext.ComponentQuery.query('#log_utility')[0];
                        log_utility.setVisible(true);
                        var user_name = Ext.ComponentQuery.query('#lblUserName')[0];
                        user_name.setText(Ext.lang.global.welcome[Ext.lang.global.langId]+' '+ userName);
                        
    
                        var lib = new MyLib;
                        var rights = lib.getRights(roleId);

                        Ext.state.Manager.set("uRights",rights);


                        var currentUser = Ext.ComponentQuery.query('#currentUser')[0];
                        currentUser.query('#cur_user')[0].setText(gData.users[0].userName);
                        currentUser.query('#cur_address')[0].setText(gData.users[0].address);
                        var roleDesc = lib.getData('role','role','id',gData.users[0].roleId);
                        currentUser.query('#cur_role')[0].setText(roleDesc);


                        var mnu=Ext.ComponentQuery.query('#log_utility')[0];
                        //mnu.collapse(true);
                        mnu.setDisabled(false);

                        var x=Ext.ComponentQuery.query("panel[itemId=loginform]")[0];
                        x.setVisible(false);
                        var x=Ext.ComponentQuery.query("panel[itemId=homeform]")[0]
                        x.setVisible(true);
                        
                        var m=Ext.ComponentQuery.query('#menumenu')[0];
                        
                        var mainmn = lib.getRows('mainmenu','status',1);
                        // for(i=0; i<mainmn.length; i++){
                            
                        //     var nodes = m.items.items[i].items.items[0].store.data;

                        //     for (n = 0 ; n<nodes.length; n++){
                        //         var mid =  nodes.items[n].data.id;
                        //         var addnl=" and menuId ='"+mid+"'";
                        //         var menuFound=lib.isFound('menutousers','userId',gData.users[0].id, addnl);
                        //         if(!menuFound){
                        //             nodes.items[n].remove(true)
                        //         }
                        //     }
                        // }

                    }else if(status==0){
                        process=false;
                        lib.showMessage(Ext.lang.global.accountInactive[Ext.lang.global.langId], Ext.Msg.CRITICAL);
                    }else if(status=-1){
                        process=false;
                        lib.showMessage( Ext.lang.global.accountBlocked[Ext.lang.global.langId], Ext.Msg.CRITICAL);
                    }    
                }else{
                    process=false;
                    var lib = new MyLib;
                    lib.showMessage(Ext.lang.global.incorectUserOrPass[Ext.lang.global.langId], Ext.Msg.CRITICAL);
                }              
            },
            failure: function(response){
            }
        });
        if(process){

            var financial = Ext.ComponentQuery.query('#financial')[0];
            var roleId=Ext.state.Manager.get("uRoleId");
            if(roleId==10){
                
                financial.setVisible(true);
                var addnl = " and entry_date_ad <='"+Ext.state.Manager.get("fyearEndDtAd")+"'";
                var assets = lib.getData('tmpentry','sum(debit)-sum(credit)','natureId','1', addnl);
                if(assets != null){
                    financial.query('#total_assets')[0].setText(assets);                    
                }
                var liabilities = lib.getData('tmpentry','sum(credit)-sum(debit)','natureId','2', addnl);
                if(liabilities != null){
                    financial.query('#total_liabilities')[0].setText(liabilities);                    
                }
                var income = lib.getData('tmpentry','sum(credit)-sum(debit)','natureId','3', addnl);
                if(income != null){
                    financial.query('#total_income')[0].setText(income);                    
                }
                var expenditure = lib.getData('tmpentry','sum(debit)-sum(credit)','natureId','4', addnl);
                if(expenditure != null){
                    financial.query('#total_expenditure')[0].setText(expenditure);                    
                }
            }else{
                financial.setVisible(false);
            }
            //----------- checking transaction date ------------//
    
            Ext.Ajax.request({
                method: 'POST',
                async:false,
                url: 'api/TranDate/trandate.php',
                scope:this,
                success: function(response){
            
                    var currTranDateAd = new Date();
                    var dtHp = new DateHelper();
                    var currTranDateBs = dtHp.ConvertAdToBs(currTranDateAd);
                    Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
                    Ext.state.Manager.set("currTranDateAd",currTranDateAd);
                    Ext.state.Manager.set("currTranDateBs",currTranDateBs);
                }
            });

            
            
        }
       
    },
    //}
    closeTrans:function(){
        var w = new ExtMVC.view.segment.TranCloser({modal:true});
        w.show();
    },
    onlogOut: function() {
        Ext.Msg.show({    
            title: Ext.lang.global.appname,
            msg: Ext.lang.msg.doLogout[Ext.lang.global.langId],
            closable : true,
            buttonText: {
                yes: Ext.lang.global.yes[Ext.lang.global.langId],
                no: Ext.lang.global.no[Ext.lang.global.langId]
            },
            icon: Ext.Msg.QUESTION,
                fn: function(btn) {        
                if (btn == 'yes') {      
                    // var currUser = Ext.ComponentQuery.query('#currUser')[0];
                    // currUser.setVisible(false);
                    var x=Ext.ComponentQuery.query("panel[itemId=loginform]")[0];
                    x.down('form').query('#txtEmail')[0].setValue(null);
                    x.down('form').query('#txtPass')[0].setValue(null);
                    x.setVisible(true);
                    var x=Ext.ComponentQuery.query("panel[itemId=homeform]")[0]
                    x.setVisible(false);
                } else {
                    return false;   
                }
            }
        });
    },
    resizePanel:function(view){
        var menuPenel = view.query('#rightPanel')[0];
        var leftPanel = view.query('#leftPanel')[0];
        menuPenel.height= window.screen.availHeight-50;
        leftPanel.height= window.screen.availHeight-50;

    },
    loadOrgData:function(view){
        var menuPenel = view.query('#menumenu')[0];
        var bannerHeight= view.query('#banner')[0].height;
        menuPenel.height= window.screen.availHeight-bannerHeight-100;

         Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
        var dtfy = Ext.ComponentQuery.query('#DtFy')[0];
        var currFiscalYear=dtfy.items.items[0].items.items[1];
        var currDate=dtfy.items.items[1].items.items[1];
       
        var dtHp = new DateHelper();
        var dt = Ext.Date.format(new Date(), 'Y-m-d');
        currTranDateAd =dt;
        currTranDateBs = dtHp.ConvertAdToBs(Ext.Date.parse(currTranDateAd,"Y-m-d"));
        
        currDate.setText(Ext.lang.global.dt[Ext.lang.global.langId]+": "+currTranDateBs);
        Ext.state.Manager.set("currTranDateAd",currTranDateAd);
        Ext.state.Manager.set("currTranDateBs",currTranDateBs);

        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            async: false,
            method: 'GET',
            url: 'api/fiscalyear/getCurrentFiscalYear.php',
            scope:this,
            success: function(response){
                
                var resData = Ext.JSON.decode(response.responseText);
                
                //debugger;
                Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
                Ext.state.Manager.set("curfYear",resData.fiscalyear[0].fiscalyear);
                Ext.state.Manager.set("fyearStartDtBs",resData.fiscalyear[0].start_date_bs);
                Ext.state.Manager.set("fyearEndDtBs",resData.fiscalyear[0].end_date_bs);
                Ext.state.Manager.set("fyearStartDtAd",resData.fiscalyear[0].start_date_ad);
                Ext.state.Manager.set("fyearEndDtAd",resData.fiscalyear[0].end_date_ad);
                currFiscalYear.setText(Ext.lang.global.fy[Ext.lang.global.langId]+" :"+resData.fiscalyear[0].fiscalyear);
            }
        });
        
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            async:false,
            url: 'api/Org/list.php',
            params: {
                    start:0,
                    limit:99999999999
            },
            scope:this,
            success: function(response){
                var gData = Ext.JSON.decode(response.responseText);        
                var orgTitle = view.query('#orgTitle')[0];
                var orgName = view.query('#orgName')[0];
                var orgAddress = view.query('#orgAddress')[0];
                orgTitle.setText(gData.orgs[0].title);
                orgName.setText(gData.orgs[0].orgName);
                orgAddress.setText(gData.orgs[0].address);
                
                //setting orginfo in session
                // Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
                Ext.state.Manager.set("gOrgId",gData.orgs[0].id);
                Ext.state.Manager.set("gOrgTitle",gData.orgs[0].title);
                Ext.state.Manager.set("gOrgName",gData.orgs[0].orgName);
                Ext.state.Manager.set("gOrgAddress",gData.orgs[0].address);
                Ext.state.Manager.set("gTelephoneNo",gData.orgs[0].telephoneNo);
                Ext.state.Manager.set("gEmail",gData.orgs[0].email);
                Ext.state.Manager.set("gRegdNo",gData.orgs[0].regdNo);
                
                var organization = Ext.ComponentQuery.query('#organization')[0];
                organization.query('#regdTitle')[0].setText(gData.orgs[0].title);
                organization.query('#regdOrgName')[0].setText(gData.orgs[0].orgName);
                organization.query('#regdOrgAddress')[0].setText(Ext.lang.global.address[Ext.lang.global.langId]+': '+gData.orgs[0].address);
                organization.query('#regdTelephoneNo')[0].setText(Ext.lang.global.contactNo[Ext.lang.global.langId]+': '+gData.orgs[0].telephoneNo);
                organization.query('#regdEmail')[0].setText(Ext.lang.global.email[Ext.lang.global.langId]+': '+gData.orgs[0].email);
                organization.query('#regdNo')[0].setText(Ext.lang.mainmenu.master.org.regdNo[Ext.lang.global.langId]+': '+gData.orgs[0].regdNo);


               //loading voucher data
                var lib  = new MyLib();
                var vouchers = Ext.ComponentQuery.query('#vouchers')[0];
                var addnl =" and fiscalyear='"+Ext.state.Manager.get("curfYear")+"'";
                var journals = lib.getRows('entry','sourceCodeId','1', addnl);
                if(journals != null){
                    vouchers.query('#no_of_journal')[0].setText(journals.length);                    
                }
                var receipts = lib.getRows('entry','sourceCodeId','3', addnl);
                if(receipts != null){
                    vouchers.query('#no_of_receipt')[0].setText(receipts.length);                    
                }
                var payments = lib.getRows('entry','sourceCodeId','2', addnl);
                if(payments != null){
                    vouchers.query('#no_of_payment')[0].setText(payments.length);
                }
            }
        });
    }    
});