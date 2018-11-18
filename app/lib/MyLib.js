Ext.define('ExtMVC.lib.MyLib', {
    alternateClassName: ['MyLib'],
    requires:[
        'Ext.ux.*'
    ],
    makeTask:function   (Msg, Delay){
        var task = Ext.create('Ext.util.DelayedTask', function() {
            Ext.getBody().mask({ xtype: 'loadmask',
            message: Msg });
        });

        task.delay(Delay);
        return task;
    },
    killTask:function   (task){
        task.cancel(); 
        Ext.getBody().unmask();
    },
    openTab:function(tabItemName){
        var tabFound=false;
        var tabPanel = Ext.ComponentQuery.query('#contentPanel')[0];
        for(i=1;i<tabPanel.items.length; i++){
            if(tabPanel.items.items[i].itemId == tabItemName.itemId){
                tabPanel.setActiveTab(tabItemName);
                tabFound=true;
            }
        }
        if(tabFound==false){
            tabPanel.add(tabItemName)                         
            tabPanel.setActiveTab(tabItemName);
        }
    },
    adjustView:function(view){
        view.height = window.screen.availHeight-280;
        
        var g = view.down('grid');
        g.height = view.height-200;
        var f=view.down('form');
    },
    adjustGridWF:function(view){
        view.height = window.screen.availHeight-200;
        view.down('grid').height = view.height-80;
    },
    adjustGrid:function(view){
        view.height = window.screen.availHeight-200;
        view.down('grid').height = view.height-120;
    },
    adjustReceipt:function(view){
        view.height = window.screen.availHeight-200;
        view.down('grid').height = view.height-245;
    },
    adjustPayment:function(view){
        view.height = window.screen.availHeight-200;
        view.down('grid').height = view.height-205;
    },
    closeWindow:function(windowId){
        Ext.Msg.show({
            title : Ext.lang.global.appName[Ext.lang.global.langId],
            msg : Ext.lang.global.closeWindow[Ext.lang.global.langId],
            width : 300,
            closable : false,
            buttons : Ext.Msg.YESNO,
            buttonText : 
            {
                yes : Ext.lang.global.yes[Ext.lang.global.langId],
                no : Ext.lang.global.no[Ext.lang.global.langId]
            },
            multiline : false,
            fn : function(buttonValue, inputText, showConfig){
                if(buttonValue=="yes"){                    
                    windowId.close();
                }
            },
            icon : Ext.Msg.QUESTION
        }); 
    },
    recordDeleter:function(windowName){
        Ext.Msg.show({
            title : Ext.lang.global.appName[Ext.lang.global.langId],
            msg : Ext.lang.msg.deleteRecord[Ext.lang.global.langId],
            width : 300,
            closable : false,
            buttons : Ext.Msg.YESNO,
            buttonText : 
            {
                yes : Ext.lang.global.yes[Ext.lang.global.langId],
                no : Ext.lang.global.no[Ext.lang.global.langId]
            },
            multiline : false,
            fn : function(buttonValue, inputText, showConfig){
                if(buttonValue=="yes"){                    
                    var w = windowName.getActiveTab();
                    var grid = w.down('grid'),
                    store = grid.store; 
                    var record = grid.getSelectionModel().getSelection();                           
                    store.remove(record);
                    grid.store.sync();     

                    Ext.Msg.show({
                        title : Ext.lang.global.appName[Ext.lang.global.langId],
                        msg : Ext.lang.global.recordDeleted[Ext.lang.global.langId],
                        width : 300,
                        closable : true,
                        buttons : Ext.Msg.OK,
                        buttonText : 
                        {
                            ok : Ext.lang.global.ok[Ext.lang.global.langId]
                        },
                        multiline : false,
                        icon:Ext.Msg.INFO
                    });                           

                }
            },
            icon : Ext.Msg.QUESTION
        });
    },
    deleteRecord:function(tableName, id){
        var curFyear=null;
        //var deleted=true;
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/deleteRecord.php',
            async: false,
            params:{
                tblName:tableName,
                id:id
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);  
               // if(tmpResData.success==true){
                 //   deleted =true;
               // }else{
                  //  deleted =false  ;
                //}
            }                            
        });
        //return   deleted    ;
    },
    runQuery:function(queryString){
        var resp=true;
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/runQuery.php',
            async: false,
            params:{
                queryString:queryString
            },
            scope:this,
            success: function(res){
                tmpResData = Ext.JSON.decode(res.responseText);                
                resp = tmpResData.success;
            }  ,
            failure:function(res){
                resp=false;
            }                          
        });
        return resp;
    },
    getOpeningBalance:function(accountNo, dateAd){
        var peningBalance=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getOpeningBalance.php',
            async: false,
            params:{
                accountNo:accountNo,
                date_ad :dateAd
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                peningBalance= tmpResData.balance;
            }                            
        });
        return peningBalance;
    },
    getOpeningBalance:function(accountNo, dateAd){
        var peningBalance=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getOpeningBalance.php',
            async: false,
            params:{
                accountNo:accountNo,
                date_ad :dateAd
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                openingBalance= tmpResData.balance;
            }                            
        });
        return openingBalance;
    },
    getGroupOpeningBalance:function(groupId, dateAd){
        var peningBalance=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getGroupOpeningBalance.php',
            async: false,
            params:{
                groupId:groupId,
                date_ad :dateAd
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                openingBalance= tmpResData.balance;
            }                            
        });
        return openingBalance;
    },
    getCollection:function(collectorId,fiscalYear,monthId,minCollection){
        var collection=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getCollection.php',
            async: false,
            params:{
                collectorId:collectorId,
                fiscalYear:fiscalYear,
                monthId:monthId,
                minCollection   : minCollection 
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                collection= tmpResData.collection;
            }                            
        });
        return collection;
    },
    setPrinted:function(fiscalyear,sourceCodeId,entryNo){
        var collection=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Entry/setPrinted.php',
            async: false,
            params:{
                fiscalyear:fiscalyear,
                sourceCodeId:sourceCodeId,
                entryNo:entryNo
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                 
            }                            
        });
        return true;
    },
    getCurFiscalYear:function(){
        var curFyear=null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/fiscalyear/getCurrentFiscalYear.php',
            async: false,
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                curFyear= tmpResData;
            }                            
        });
        return curFyear;
    },
    getAccountBalance:function(fiscalYear, sourceCodeId, entryNo, accountNo){
        var balance=null;
        if(entryNo=='नयाँ'){
            entryNo='New';
        }
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getAccountBalance.php',
            async: false,
            params:{
                fiscalYear: fiscalYear,
                sourceCodeId:sourceCodeId,
                entryNo:entryNo,
                accountNo:accountNo
            },
            scope:this,
            success: function(res){
                
                tmpResData= Ext.JSON.decode(res.responseText);                
                balance= tmpResData.balance;
            }                            
        });
        return balance;
    },
    getAccountsPayable:function(fiscalYear, sourceCodeId, entryNo, accountNo){
        var balance=null;
        if(entryNo=='नयाँ'){
            entryNo='New';
        }
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Account/getAccountBalance.php',
            async: false,
            params:{
                fiscalYear: fiscalYear,
                sourceCodeId:sourceCodeId,
                entryNo:entryNo,
                accountNo:accountNo
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                balance= tmpResData.balancePayable;
            }                            
        });
        return balance;
    },
    getSavingInterestRate:function(accountNo, effectiveFrom){
        var rate= null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/SavingIntRate/getSavingInterestRate.php',
            async: false,
            params:{
                accountNo:accountNo,
                effectiveFrom:effectiveFrom
            },
            scope:this,
            success: function(res){                
                tmpResData= Ext.JSON.decode(res.responseText);                
                rate= tmpResData.rate;
            }                            
        });
        return rate;
    },
    getLoanInterest:function(accountNo, calculationDateAd){
        var interest= null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/CalcLoanInt/calculateLoanInterest.php',
            async: false,
            params:{
                accountNo:accountNo,
                effectiveFrom:calculationDateAd
            },
            scope:this,
            success: function(res){                
                tmpResData= Ext.JSON.decode(res.responseText);                
                interest= tmpResData.interest;
            }                            
        });
        return interest;
    },
    
    getReportHeader:function  (reportName ){
        var logopath = "resources/images/logo.png";
        
        var head="<table width='100%' border='0px' align='center' style='font-family:Kalimati; font-size:12'><tr> ";
        head=head+    "<td width='15%' align='right'><img src='" + logopath + "' height='50' width='50'></td>";
        head=head+    "<td width='70%' align='center'>";
        
        head=head+    "<span style='font-family: cooper black; font-size:20'><b>"+Ext.state.Manager.get("gOrgName")+"</b></span><br />";
        head=head+    "<span style='font-size:12'>"+Ext.state.Manager.get("gOrgAddress")+"</span></br>";
        var contactNo="";
        if(Ext.state.Manager.get("gOrgContactNo")!=""){
            contactNo=Ext.lang.global.contactNo[Ext.lang.global.langId]+": "+Ext.state.Manager.get("gOrgContactNo");
            if(Ext.state.Manager.get("gOrgEmail")!=""){
                if(contactNo==""){
                    contactNo="Email: "+Ext.state.Manager.get("gOrgEmail");
                }else{
                    contactNo=contactNo+", Email: "+Ext.state.Manager.get("gOrgEmail");
                }
            }
        }
        head=head+    "<span style='font-size:12; width:400'>"+contactNo+"</span></td>";
        head=head+    "<td width='15%' align='right'></td></tr></table>";        
        head=head+    "<div align='center' width='100%' style='border-top:1px solid black'><div style='margin-bottom:5px; margin-top:5px'><label style='font-weight:bold;background-color:#000; color:#fff; border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000; border-bottom:1px solid #000;padding:2px;border-radius:3px;'> " + reportName + "</label></div></div>";
        return   head;
    },
    getReportFooter:function    (){
        return "</br></br><table width='100%' align ='center' style='font-family:Kalimati; font-size:12'><tr><td width='20%' align ='left' valign='bottom'><div width='100%' align='center'>"+Ext.state.Manager.get("uName")+"<br>___________</br>"+Ext.lang.global.preparedBy[Ext.lang.global.langId]+"</div></td><td width='60%' align ='center' valign='bottom'><div width='100%' align='center'><br>___________</br>"+Ext.lang.global.checkedBy[Ext.lang.global.langId]+"</div></td><td width='20%' align ='right' valign='bottom'><div width='100%' align='center'><br>___________</br>"+Ext.lang.global.approvedBy[Ext.lang.global.langId]+"</div></td></tr></table>";
    },
    getReportFooterPayment:function    (){
        //var ftr="<div width='100%' style='A_CSS_ATTRIBUTE:all;position: absolute;bottom: 10px; left: 10px;'></br><table width='100%' align ='center' style='font-size:14'><tr><td width:'20%' align ='left'>"+Ext.state.Manager.get("uName")+"<br>_______________</br>"+Ext.lang.global.preparedBy+"</td><td width:'60%' align ='center'><br>_______________</br>"+Ext.lang.global.checkedBy+"</td><td width:'20%' align ='right'><br>_______________</br>"+Ext.lang.global.approvedBy+"</td></tr></table> </div>";
        var ftr = "</br><table width='100%' align ='center' style='font-family:Kalimati; font-size:12'><tr><td width='20%' align ='left'><div width='100%' align='center'>___________</br>"+Ext.lang.global.preparedBy[Ext.lang.global.langId]+"</div></td><td width='60%' align ='center'><div width='100%' align='center'>___________</br>"+Ext.lang.global.receivedBy[Ext.lang.global.langId]+"</div></td><td width='20%' align ='right'><div width='100%' align='center'>___________</br>"+Ext.lang.global.approvedBy[Ext.lang.global.langId]+"</div></td></tr></table>";
        return ftr;
        //return "</br>";
    },
    getReportFooterReceipt:function    (){
        //var ftr="<div width='100%' style='A_CSS_ATTRIBUTE:all;position: absolute;bottom: 10px; left: 10px;'></br><table width='100%' align ='center' style='font-size:14'><tr><td width:'20%' align ='left'>"+Ext.state.Manager.get("uName")+"<br>_______________</br>"+Ext.lang.global.preparedBy+"</td><td width:'60%' align ='center'><br>_______________</br>"+Ext.lang.global.checkedBy+"</td><td width:'20%' align ='right'><br>_______________</br>"+Ext.lang.global.approvedBy+"</td></tr></table> </div>";
        var ftr = "</br><table width='100%' align ='center' style='font-family:Kalimati; font-size:12'><tr><td width='20%' align ='left'><div width='100%' align='center'>___________</br>"+Ext.lang.global.preparedBy[Ext.lang.global.langId]+"</div></td><td width='60%' align ='center'><div width='100%' align='center'>___________</br>"+Ext.lang.global.receivedBy[Ext.lang.global.langId]+"</div></td><td width='20%' align ='right'><div width='100%' align='center'>___________</br>"+Ext.lang.global.approvedBy[Ext.lang.global.langId]+"</div></td></tr></table>";
        return ftr;
        //return "</br>";
    },
    gridToHtml:function(grid, numRows , reportHeader, pageHeader, ord){
        var gs = grid.getStore();
        var nbCols = grid.columns.length;

        var nbRows = grid.getStore().count();
        var tbl="";
        //var tblHd="<tr style='background-color:blue'>";
        var gridWidth = grid.getView().getWidth();
        if(reportHeader!=undefined){
            tbl = tbl+reportHeader;    
        }
        if(pageHeader!=undefined){
            tbl = tbl + pageHeader;
        }
        tbl = tbl +"<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:10;'>";
        page= 1;
        var c =0;
        if(ord=="-"){
            for (i=nbRows-1; i>=0; i--){
                var r = gs.getAt(i);
                tbl = tbl +"<tr>";
                if(c==0){
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }else if((c>0) && (c%numRows==0)){
                    tbl = tbl +"</table><br><br>";
                    tbl = tbl + "</br><table width='100%' align ='center'><tr><td width:'20%' align ='left' valign='bottom'>"+Ext.state.Manager.set("uName")+"<br>___________</br>"+Ext.lang.global.preparedBy[Ext.lang.global.langId]+"</td><td width:'60%' align ='center'><br>___________</br>"+Ext.lnag.global.checkedBy+"</td><td width:'20%' align ='right'><br>___________</br>"+Ext.lang.global.approvedBy[Ext.lang.global.langId]+"</td></tr></table>";
                    tbl    = tbl   +"<div align='center'>Page: "+page+"</div><br>";
                    page = page+1;
                    tbl = tbl+reportHeader;
                    tbl = tbl + pageHeader;

                    tbl = tbl + "<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:14;'>";
                    tbl = tbl +"<tr>";
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }
                for (j=0;j<nbCols; j++){
                     
                    if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                    }else{
                        var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                        if(r==undefined){
                            Ext.alert(colName);
                        }
                        var cellValue = r.get(colName);
                        if(colName=="status"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.active[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.passive[Ext.lang.global.langId];
                            }
                        }else if((colName=="Auto") || (colName=="smsAlert") || (colName=="eBanking")  || (colName=="ebanking")){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.yes[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.no[Ext.lang.global.langId];
                            }
                        }else if(colName=="gender"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.male[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.female[Ext.lang.global.langId];
                            }
                        }else if(colName=="accountTypeId"){
                            if(r.get(colName)=="1"){
                                var cellValue =Ext.lang.global.savingAc[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="2"){
                                var cellValue = Ext.lang.global.currentAc[Ext.lang.global.langId];
                            }else if(r.get(colName)=="3"){
                                var cellValue = Ext.lang.global.fixedDepositAc[Ext.lang.global.langId];
                            }
                        }else if(colName=="marital_status"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.married[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.unmarried[Ext.lang.global.langId];
                            }
                        }else{
                            if(r.get(colName)==null){
                                var cellValue = "";
                            }else{
                                var cellValue = r.get(colName);
                            }
                            
                        }
                        var colAlign = grid.getView().getHeaderAtIndex(j).align;
                        tbl = tbl + "<td style='border:1px solid black' align ='"+colAlign+"'>"+cellValue+"</td>";
                    }
                       
                }
                c=c+1;
                tbl = tbl +"</tr>";            
            }
        }else{
            for (i=0; i<nbRows; i++){
                var r = gs.getAt(i);
                tbl = tbl +"<tr>";
                if(i==0){
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }else if((i>0) && (i%numRows==0)){
                    tbl = tbl +"</table><br><br>";
                    tbl = tbl + "</br><table width='100%' align ='center'><tr><td width:'20%' align ='left' valign='bottom'>"+Ext.state.Manager.set("uName")+"<br>___________</br>"+Ext.lang.global.preparedBy[Ext.lang.global.langId]+"</td><td width:'60%' align ='center'><br>___________</br>"+Ext.lnag.global.checkedBy[Ext.lang.global.langId]+"</td><td width:'20%' align ='right'><br>___________</br>"+Ext.lang.global.approvedBy[Ext.lang.global.langId]+"</td></tr></table>";
                    tbl    = tbl   +"<div align='center'>Page: "+page+"</div><br>";
                    page = page+1;
                    tbl = tbl+reportHeader;
                    tbl = tbl + pageHeader;

                    tbl = tbl + "<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:14;'>";
                    tbl = tbl +"<tr>";
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }
                for (j=0;j<nbCols; j++){
                     
                    if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                    }else{
                        var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                        if(r==undefined){
                            Ext.alert(colName);
                        }
                        var cellValue = r.get(colName);
                        if(colName=="status"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.active[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.passive[Ext.lang.global.langId];
                            }
                        }else if((colName=="Auto") || (colName=="smsAlert") || (colName=="eBanking")  || (colName=="ebanking")){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.yes[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.no[Ext.lang.global.langId];
                            }
                        }else if(colName=="gender"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.male[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.female[Ext.lang.global.langId];
                            }
                        }else if(colName=="accountTypeId"){
                            if(r.get(colName)=="1"){
                                var cellValue =Ext.lang.global.savingAc[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="2"){
                                var cellValue = Ext.lang.global.currentAc[Ext.lang.global.langId];
                            }else if(r.get(colName)=="3"){
                                var cellValue = Ext.lang.global.fixedDepositAc[Ext.lang.global.langId];
                            }
                        }else if(colName=="marital_status"){
                            if(r.get(colName)=="1"){
                                var cellValue = Ext.lang.global.married[Ext.lang.global.langId];        
                            }else if(r.get(colName)=="0"){
                                var cellValue = Ext.lang.global.unmarried[Ext.lang.global.langId];
                            }
                        }else{
                            if(r.get(colName)==null){
                                var cellValue = "";
                            }else{
                                var cellValue = r.get(colName);
                            }
                        }
                        var colAlign = grid.getView().getHeaderAtIndex(j).align;
                        tbl = tbl + "<td style='border:1px solid black' align ='"+colAlign+"'>"+cellValue+"</td>";
                    }
                }
                tbl = tbl +"</tr>";            
            }
        } 
        
        //tblHd=tblHd+"</tr>";
        // var fullTable  = "<table '>"+tblHd+tbl+"</table>";
        tbl = tbl +"</table>";
        return tbl;
    },
    gridToPureHtml:function(grid, numRows , reportHeader, pageHeader, ord){
        var gs = grid.getStore();
        var nbCols = grid.columns.length;

        var nbRows = grid.getStore().count();
        var tbl="";
        //var tblHd="<tr style='background-color:blue'>";
        var gridWidth = grid.getView().getWidth();
        if(reportHeader!=undefined){
            tbl = tbl+reportHeader;    
        }
        if(pageHeader!=undefined){
            tbl = tbl + pageHeader;
        }
        tbl = tbl +"<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:14;'>";
        page= 1;
        var c =0;
        if(ord=="-"){
            for (i=nbRows-1; i>=0; i--){
                var r = gs.getAt(i);
                tbl = tbl +"<tr>";
                if(c==0){
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }else if((c>0) && (c%numRows==0)){
                    tbl = tbl +"</table><br><br>";
                    tbl = tbl + "</br><table width='100%' align ='center'><tr><td width:'20%' align ='left'>___________</br>Prepared By</td><td width:'60%' align ='center'>___________</br>Checked By</td><td width:'20%' align ='right'>___________</br>Approved By</td></tr></table>";
                    tbl    = tbl   +"<div align='center'>Page: "+page+"</div><br>";
                    page = page+1;
                    tbl = tbl+reportHeader;
                    tbl = tbl + pageHeader;

                    tbl = tbl + "<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:14;'>";
                    tbl = tbl +"<tr>";
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }
                for (j=0;j<nbCols; j++){
                     
                    if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                    }else{
                        var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                        if(r==undefined){
                            Ext.alert(colName);
                        }
                        var cellValue = r.get(colName);
                        if(colName=="status"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Active";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Passive";
                            }
                        }else if((colName=="Auto") || (colName=="smsAlert") || (colName=="eBanking")  || (colName=="ebanking")){
                            if(r.get(colName)=="1"){
                                var cellValue = "Yes";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "No";
                            }
                        }else if(colName=="gender"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Male";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Female";
                            }
                        }else if(colName=="accountTypeId"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Saving A/C";        
                            }else if(r.get(colName)=="2"){
                                var cellValue = "Fixed Deposit";
                            }else if(r.get(colName)=="3"){
                                var cellValue = "Current A/C";
                            }
                        }else if(colName=="marital_status"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Married";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Unmarried";
                            }
                        }else{
                            if(r.get(colName)==null){
                                var cellValue = "";
                            }else{
                                var cellValue = r.get(colName);
                            }
                            
                        }
                        var colAlign = grid.getView().getHeaderAtIndex(j).align;
                        tbl = tbl + "<td style='border:1px solid black' align ='"+colAlign+"'>"+cellValue+"</td>";
                    }
                       
                }
                c=c+1;
                tbl = tbl +"</tr>";            
            }
        }else{
            for (i=0; i<nbRows; i++){
                var r = gs.getAt(i);
                tbl = tbl +"<tr>";
                if(i==0){
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }else if((i>0) && (i%numRows==0)){
                    tbl = tbl +"</table><br><br>";
                    tbl = tbl + "</br><table width='100%' align ='center'><tr><td width:'20%' align ='left'>___________</br>Prepared By</td><td width:'60%' align ='center'>___________</br>Checked By</td><td width:'20%' align ='right'>___________</br>Approved By</td></tr></table>";
                    tbl    = tbl   +"<div align='center'>Page: "+page+"</div><br>";
                    page = page+1;
                    tbl = tbl+reportHeader;
                    tbl = tbl + pageHeader;

                    tbl = tbl + "<table width='100%' border='1' align='center' style='border:1px solid; border-collapse:collapse; font-family:Kalimati;  font-size:14;'>";
                    tbl = tbl +"<tr>";
                    for (j=0;j<nbCols; j++){
                        if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                        }else{
                            var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                            var cellValue = r.get(colName);
                            var colWidth= grid.getView().getHeaderAtIndex(j).getWidth();
                            var colWidthPer = (colWidth/gridWidth)*100;
                            var colAlign = 'center';
                            tbl = tbl + "<th style='border:1px solid black' width='"+colWidthPer+"%' align='"+colAlign+"'>"+grid.getView().getHeaderAtIndex(j).text+"</th>"; 
                        }
                    }
                    tbl = tbl +"</tr><tr>";
                }
                for (j=0;j<nbCols; j++){
                     
                    if((grid.getView().getHeaderAtIndex(j).hidden==true) || (grid.getView().getHeaderAtIndex(j).text=="Action")){
                    }else{
                        var colName = grid.getView().getHeaderAtIndex(j).dataIndex;
                        if(r==undefined){
                            Ext.alert(colName);
                        }
                        var cellValue = r.get(colName);
                        if(colName=="status"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Active";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Passive";
                            }
                        }else if((colName=="Auto") || (colName=="smsAlert") || (colName=="eBanking")  || (colName=="ebanking")){
                            if(r.get(colName)=="1"){
                                var cellValue = "Yes";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "No";
                            }
                        }else if(colName=="gender"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Male";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Female";
                            }
                        }else if(colName=="accountTypeId"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Saving A/C";        
                            }else if(r.get(colName)=="2"){
                                var cellValue = "Fixed Deposit";
                            }else if(r.get(colName)=="3"){
                                var cellValue = "Current A/C";
                            }
                        }else if(colName=="marital_status"){
                            if(r.get(colName)=="1"){
                                var cellValue = "Married";        
                            }else if(r.get(colName)=="0"){
                                var cellValue = "Unmarried";
                            }
                        }else{
                            if(r.get(colName)==null){
                                var cellValue = "";
                            }else{
                                var cellValue = r.get(colName);
                            }
                            
                        }
                        var colAlign = grid.getView().getHeaderAtIndex(j).align;
                        tbl = tbl + "<td style='border:1px solid black' align ='"+colAlign+"'>"+cellValue+"</td>";
                    }
                       
                }
                
                tbl = tbl +"</tr>";            
            }
        } 
        
        //tblHd=tblHd+"</tr>";
        // var fullTable  = "<table '>"+tblHd+tbl+"</table>";
        tbl = tbl +"</table>";
        return tbl;
    },
    printReport:function (fullReport){
        
        
        var mywindow = window.open();
        var is_chrome = Boolean(mywindow.chrome);
        mywindow.document.write(fullReport);

        if (is_chrome) {
            setTimeout(function () { // wait until all resources loaded 
                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10
                    mywindow.print();  // change window to winPrint
                    mywindow.close();// change window to winPrint
            }, 250);
        }
        else {
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10

            mywindow.print();
            mywindow.close();
        }

        return true;
    },
    getItemStock:function(itemId, unitId, fiscalYear, sourceCodeId, entryNo){
        var criteria="";
        var stock=0;
        if(fiscalYear!=""){
            if(criteria==""){
                criteria = " and not (fiscalYear='"+fiscalYear+"' and sourceCodeId='"+sourceCodeId+"' and entryNo='"+entryNo+"')";
            }
        }
        //getting stock info
        Ext.Ajax.request({
            waitMsg: 'Searching...', 
            method: 'POST',
            async: false,
            url: 'api/invitem/getItemStock.php',
            params:{
                itemId:itemId,
                cr:criteria,
                unitId:unitId
            },
            scope:this,
            success: function(response){
                var gData = Ext.JSON.decode(response.responseText); 
                stock=gData.stock;                
            }
            
        }); 
        return stock; 
    },
    getPrinterStatus:function(fiscalYear, sourceCodeId, entryNo, userId){
        
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Voucher/setPrinterStatus.php',
            async: false,
            params:{
                fiscalYear:fiscalYear,
                sourceCodeId:sourceCodeId,
                entryNo:entryNo,
                userId:userId
            },
            scope:this,
            success: function(res){
                updated=true;
            },
            failure:function(){            
                updated=false;
            }                            
        });
        return updated;
    },
    setApprovalStatus:function(fiscalYear, sourceCodeId, entryNo, userId, approvalDateBs){
        
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Voucher/setApprovalStatus.php',
            async: false,
            params:{
                fiscalYear:fiscalYear,
                sourceCodeId:sourceCodeId,
                entryNo:entryNo,
                userId:userId,
                approvedDate:approvalDateBs
            },
            scope:this,
            success: function(res){             
                updated=true;
            },
            failure:function(){            
                updated=false;
            }                            
        });
        return updated;
    },
    
    getRights:function(roleId){
        Ext.Ajax.request({
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            waitTitle: 'Connecting',
            waitMsg: 'Receiving data...',
            url: 'api/Roles/rights/getUserRights.php',
            async: false,
            params: {
                    roleId:roleId
            },
            scope:this,
            success: function(res){            
                resData= Ext.JSON.decode(res.responseText);                
            }
        });
        return resData.rights;
    },
    getNewCode:function(tableName,returnField,searchField,searchValue){
        var tmpNewCode="";
        var qs="select "+returnField+" from "+tableName+" where "+searchField+"='"+searchValue+"' order by id desc limit 1";
        
        Ext.Ajax.request({
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            waitTitle: 'Connecting',
            waitMsg: 'Receiving data...',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:qs
            },
            scope:this,
            success: function(res){
              
                resData= Ext.JSON.decode(res.responseText);
                
                if(resData.count>0){
                    tmpNewCode= parseInt(resData.data[0].segment_code) +1;
                
                }else{
                    tmpNewCode= 1;
                }
                tmpNewCode = "0000000000"+tmpNewCode;
                //var lnth=this.getDat("segment","ln","id",searchValue)
                tmpNewCode= tmpNewCode.slice(7);
                
            },
        failure: function (err) {
            alert(1);
            // body...
        }
                                         
        });
        return tmpNewCode;
    },
    getMaxValue:function(tableName,returnField,searchField,searchValue, ordrby){
        var tmpNewCode="";
        var qs="select "+returnField+" as rtrnfld from "+tableName+" where "+searchField+"="+searchValue+" order by "+ordrby+" desc limit 1";
        Ext.Ajax.request({
            method: 'POST',
            async: false,
            url: 'includes/getData.php',
            params: {
                    queryString:qs
            },
            scope:this,
            success: function(res){
                resData= Ext.JSON.decode(res.responseText);
                if(resData.count>0){
                    tmpNewCode= resData.data[0].rtrnfld;
                
                }else{
                    tmpNewCode= null;
                }
            },
        failure: function (err) {
           tmpNewCode= err;
        }
                                         
        });
        return tmpNewCode;
    },
    getDat:function(tableName,returnField,searchField,searchValue){
        var tNewCode="";
        var tmpQryString="select "+returnField+" as dt from "+tableName+" where "+searchField+"='"+searchValue+"' order by id desc limit 1";
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);
                
                if(tmpResData.count>0){
                    
                    tNewCode= tmpResData.data[0].dt;
                
                }else{
                    tNewCode= null;
                }
                  
            },
             failure: function (err) {
                alert(1);
            // body...
            }
                               
        });
        return tNewCode; 
    },
    isRecordFound:function(tableName,searchField,searchValue){
        
        var tmpQryString="select * from "+tableName+" where "+searchField+"='"+searchValue+"'";
        var fnd=true;
        Ext.Ajax.request({
            method: 'GET',
            async: false,
            url: 'includes/countRecord.php',
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                
                tmpResData= Ext.JSON.decode(res.responseText);
                if(tmpResData.found){
                    fnd= true;
                }else{
                    fnd= false;
                }
            }
        });
        return fnd; 
    },
    isFound:function(tableName,searchField,searchValue, additionCriteria){
        if(Ext.isEmpty(additionCriteria)){
            var tmpQryString="select * from "+tableName+" where "+searchField+"='"+searchValue+"'";    
        }else{
            var tmpQryString="select * from "+tableName+" where "+searchField+"='"+searchValue+"' "+additionCriteria;
        }
        
        var fnd=true;
        Ext.Ajax.request({
            method: 'GET',
            async: false,
            url: 'includes/countRecord.php',
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);
                if(tmpResData.found){
                    fnd= true;
                }else{
                    fnd= false;
                }
            }
        });
        return fnd; 
    },
    getData:function(tableName,returnField,searchField,searchValue, additionCriteria){
        var tNewCode="";
        var cr = null;
        if(Ext.isEmpty(additionCriteria)){

            var tmpQryString="select "+returnField+" as dt from "+tableName+" where "+searchField+"='"+searchValue+"' order by id desc limit 1";
        }else{
            var tmpQryString="select "+returnField+" as dt from "+tableName+" where "+searchField+"='"+searchValue+"'"+additionCriteria+" order by id desc limit 1";
        }

        
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);
                
                if(tmpResData.count>0){
                    
                    tNewCode= tmpResData.data[0].dt;
                
                }else{
                    tNewCode= null;
                }
                  
            },
             failure: function (err) {
               tNewCode= null;
            }
                               
        });
        return tNewCode; 
    },
    getValue:function(tableName,returnField,searchField,relation,searchValue, additionCriteria){
        var tNewCode="";
        var cr = null;
        if(Ext.isEmpty(additionCriteria)){

            var tmpQryString="select "+returnField+" as dt from "+tableName+" where "+searchField+relation+"'"+searchValue+"' order by id desc limit 1";
        }else{
            var tmpQryString="select "+returnField+" as dt from "+tableName+" where "+searchField+relation+"'"+searchValue+searchValue+"'"+additionCriteria+" order by id desc limit 1";
        }

        
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                if(tmpResData.count>0){
                    
                    tNewCode= tmpResData.data[0].dt;
                
                }else{
                    tNewCode= null;
                }
                  
            },
             failure: function (err) {
                alert(1);
            // body...
            }
                               
        });
        return tNewCode; 
        
    },
    getNewEntryNo:function(fiscalYear,sourceCode){
        tNewCode:null;
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/newEntryNo.php',
            async: false,
            params: {
                    fiscalYear:fiscalYear,
                    sourceCode:sourceCode
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                tNewCode= tmpResData.newEntryNo;
            }                            
        });
        return tNewCode;
    },
    showMessage:function(msg,icon){
        Ext.Msg.show({
            title : Ext.lang.global.appName[Ext.lang.global.langId],
            msg : msg,
            width : 300,
            closable : true,
            buttons : Ext.Msg.OK,
            buttonText : 
            {
                ok : Ext.lang.global.ok[Ext.lang.global.langId]
            },
            multiline : false,
            icon:icon
        });
    },
    maintainEntry:function(fiscalYear,sourceCodeId, entryNo, amount, dateBs, dateAd, inWords){
        Ext.Ajax.request({
            method: 'GET',
            url: 'api/Entry/maintainEntry.php',
            async: false,
            params: {
                    fiscalyear:fiscalYear,
                    sourceCodeId:sourceCodeId,
                    entryNo:entryNo,
                    amount:amount,
                    dateBs:dateBs,
                    dateAd:dateAd,
                    inWords:inWords
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);                
                result= tmpResData.result;
            }                            
        });
        return result;
    },
    getRows:function(tableName,searchField,searchValue, additionCriteria){
        var tNewCode=null;
        
        if(Ext.isEmpty(additionCriteria)){
            var tmpQryString="select * from "+tableName+" where "+searchField+"='"+searchValue+"'";
        }else{
            var tmpQryString="select * from "+tableName+" where "+searchField+"='"+searchValue+"'"+additionCriteria;
        }
        
        
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);
                
                if(tmpResData.count>0){                    
                    tNewCode= tmpResData.data;                
                }else{
                    tNewCode= null;
                }
                  
            },
             failure: function (err) {
                alert(err);
            }
                               
        });
        return tNewCode; 
    },


    getDailyCollection:function(searchField,searchValue, additionCriteria){
        var tNewCode=null;
        
        if(Ext.isEmpty(additionCriteria)){
            var tmpQryString="select sum(credit) as credit entry_date_bs from tmpentry where "+searchField+"='"+searchValue+"' group by entry_date_bs";
        }else{
            var tmpQryString="select sum(credit) as credit, entry_date_bs from tmpentry where "+searchField+"='"+searchValue+"'"+additionCriteria+" group by entry_date_bs";
        }
        
        Ext.Ajax.request({
            method: 'GET',
            url: 'includes/getData.php',
            async: false,
            params: {
                    queryString:tmpQryString
            },
            scope:this,
            success: function(res){
                tmpResData= Ext.JSON.decode(res.responseText);
                if(tmpResData.count>0){
                    tNewCode= tmpResData.data;
                }else{
                    tNewCode= null;
                }               
            },
             failure: function (err) {
                alert(err);
            }                               
        });
        return tNewCode; 
    },

    getAkshar:function(num){
        if(num==1){
            return Ext.lang.akshar.n1[Ext.lang.global.langId];
        }else if(num==2){
            return Ext.lang.akshar.n2[Ext.lang.global.langId];
        }else if(num==3){
            return Ext.lang.akshar.n3[Ext.lang.global.langId];
        }else if(num==4){
            return Ext.lang.akshar.n4[Ext.lang.global.langId];
        }else if(num==5){
            return Ext.lang.akshar.n5[Ext.lang.global.langId];
        }else if(num==6){
            return Ext.lang.akshar.n6[Ext.lang.global.langId];
        }else if(num==7){
            return Ext.lang.akshar.n7[Ext.lang.global.langId];
        }else if(num==8){
            return Ext.lang.akshar.n8[Ext.lang.global.langId];
        }else if(num==9){
            return Ext.lang.akshar.n9[Ext.lang.global.langId];
        }else if(num==10){
            return Ext.lang.akshar.n10[Ext.lang.global.langId];
        }else if(num==11){
            return Ext.lang.akshar.n11[Ext.lang.global.langId];
        }else if(num==12){
            return Ext.lang.akshar.n12[Ext.lang.global.langId];
        }else if(num==13){
            return Ext.lang.akshar.n13[Ext.lang.global.langId];
        }else if(num==14){
            return Ext.lang.akshar.n14[Ext.lang.global.langId];
        }else if(num==15){
            return Ext.lang.akshar.n15[Ext.lang.global.langId];
        }else if(num==16){
            return Ext.lang.akshar.n16[Ext.lang.global.langId];
        }else if(num==17){
            return Ext.lang.akshar.n17[Ext.lang.global.langId];
        }else if(num==18){
            return Ext.lang.akshar.n18[Ext.lang.global.langId];
        }else if(num==19){
            return Ext.lang.akshar.n19[Ext.lang.global.langId];
        }else if(num==20){
            return Ext.lang.akshar.n20[Ext.lang.global.langId];
        }else if(num==21){
            return Ext.lang.akshar.n21[Ext.lang.global.langId];
        }else if(num==22){
            return Ext.lang.akshar.n22[Ext.lang.global.langId];
        }else if(num==23){
            return Ext.lang.akshar.n23[Ext.lang.global.langId];
        }else if(num==24){
            return Ext.lang.akshar.n24[Ext.lang.global.langId];
        }else if(num==25){
            return Ext.lang.akshar.n25[Ext.lang.global.langId];
        }else if(num==26){
            return Ext.lang.akshar.n26[Ext.lang.global.langId];
        }else if(num==27){
            return Ext.lang.akshar.n27[Ext.lang.global.langId];
        }else if(num==28){
            return Ext.lang.akshar.n28[Ext.lang.global.langId];
        }else if(num==29){
            return Ext.lang.akshar.n29[Ext.lang.global.langId];
        }else if(num==30){    
            return Ext.lang.akshar.n30[Ext.lang.global.langId];
        }else if(num==31){
            return Ext.lang.akshar.n31[Ext.lang.global.langId];
        }else if(num==32){
            return Ext.lang.akshar.n32[Ext.lang.global.langId];
        }else if(num==33){
            return Ext.lang.akshar.n33[Ext.lang.global.langId];
        }else if(num==34){
            return Ext.lang.akshar.n34[Ext.lang.global.langId];
        }else if(num==35){
            return Ext.lang.akshar.n35[Ext.lang.global.langId];
        }else if(num==36){
            return Ext.lang.akshar.n36[Ext.lang.global.langId];
        }else if(num==37){
            return Ext.lang.akshar.n37[Ext.lang.global.langId];
        }else if(num==38){
            return Ext.lang.akshar.n38[Ext.lang.global.langId];
        }else if(num==39){
            return Ext.lang.akshar.n39[Ext.lang.global.langId];
        }else if(num==40){
            return Ext.lang.akshar.n40[Ext.lang.global.langId];
        }else if(num==41){
            return Ext.lang.akshar.n41[Ext.lang.global.langId];
        }else if(num==42){
            return Ext.lang.akshar.n42[Ext.lang.global.langId];
        }else if(num==43){
            return Ext.lang.akshar.n43[Ext.lang.global.langId];
        }else if(num==44){
            return Ext.lang.akshar.n44[Ext.lang.global.langId];
        }else if(num==45){
            return Ext.lang.akshar.n45[Ext.lang.global.langId];
        }else if(num==46){
            return Ext.lang.akshar.n46[Ext.lang.global.langId];
        }else if(num==47){
            return Ext.lang.akshar.n47[Ext.lang.global.langId];
        }else if(num==48){
            return Ext.lang.akshar.n48[Ext.lang.global.langId];
        }else if(num==49){
            return Ext.lang.akshar.n49[Ext.lang.global.langId];
        }else if(num==50){
            return Ext.lang.akshar.n50[Ext.lang.global.langId];
        }else if(num==51){
            return Ext.lang.akshar.n51[Ext.lang.global.langId];
        }else if(num==52){
            return Ext.lang.akshar.n52[Ext.lang.global.langId];
        }else if(num==53){
            return Ext.lang.akshar.n53[Ext.lang.global.langId];
        }else if(num==54){
            return Ext.lang.akshar.n54[Ext.lang.global.langId];
        }else if(num==55){
            return Ext.lang.akshar.n55[Ext.lang.global.langId];
        }else if(num==56){
            return Ext.lang.akshar.n56[Ext.lang.global.langId];
        }else if(num==57){
            return Ext.lang.akshar.n57[Ext.lang.global.langId];
        }else if(num==58){
            return Ext.lang.akshar.n58[Ext.lang.global.langId];
        }else if(num==59){
            return Ext.lang.akshar.n59[Ext.lang.global.langId];
        }else if(num==60){
            return Ext.lang.akshar.n60[Ext.lang.global.langId];
        }else if(num==61){
            return Ext.lang.akshar.n61[Ext.lang.global.langId];
        }else if(num==62){
            return Ext.lang.akshar.n62[Ext.lang.global.langId];
        }else if(num==63){
            return Ext.lang.akshar.n63[Ext.lang.global.langId];
        }else if(num==64){
            return Ext.lang.akshar.n64[Ext.lang.global.langId];
        }else if(num==65){
            return Ext.lang.akshar.n65[Ext.lang.global.langId];
        }else if(num==66){
            return Ext.lang.akshar.n66[Ext.lang.global.langId];
        }else if(num==67){
            return Ext.lang.akshar.n67[Ext.lang.global.langId];
        }else if(num==68){
            return Ext.lang.akshar.n68[Ext.lang.global.langId];
        }else if(num==69){
            return Ext.lang.akshar.n69[Ext.lang.global.langId];
        }else if(num==70){
            return Ext.lang.akshar.n70[Ext.lang.global.langId];
        }else if(num==71){
            return Ext.lang.akshar.n71[Ext.lang.global.langId];
        }else if(num==72){
            return Ext.lang.akshar.n72[Ext.lang.global.langId];
        }else if(num==73){
            return Ext.lang.akshar.n73[Ext.lang.global.langId];
        }else if(num==74){
            return Ext.lang.akshar.n74[Ext.lang.global.langId];
        }else if(num==75){
            return Ext.lang.akshar.n75[Ext.lang.global.langId];
        }else if(num==76){
            return Ext.lang.akshar.n76[Ext.lang.global.langId];
        }else if(num==77){
            return Ext.lang.akshar.n77[Ext.lang.global.langId];
        }else if(num==78){
            return Ext.lang.akshar.n78[Ext.lang.global.langId];
        }else if(num==79){
            return Ext.lang.akshar.n79[Ext.lang.global.langId];
        }else if(num==80){
            return Ext.lang.akshar.n80[Ext.lang.global.langId];
        }else if(num==81){
            return Ext.lang.akshar.n81[Ext.lang.global.langId];
        }else if(num==82){
            return Ext.lang.akshar.n82[Ext.lang.global.langId];
        }else if(num==83){
            return Ext.lang.akshar.n83[Ext.lang.global.langId];
        }else if(num==84){
            return Ext.lang.akshar.n84[Ext.lang.global.langId];
        }else if(num==85){
            return Ext.lang.akshar.n85[Ext.lang.global.langId];
        }else if(num==86){
            return Ext.lang.akshar.n86[Ext.lang.global.langId];
        }else if(num==87){
            return Ext.lang.akshar.n87[Ext.lang.global.langId];
        }else if(num==88){
            return Ext.lang.akshar.n88[Ext.lang.global.langId];
        }else if(num==89){
            return Ext.lang.akshar.n89[Ext.lang.global.langId];
        }else if(num==90){
            return Ext.lang.akshar.n90[Ext.lang.global.langId];
        }else if(num==91){
            return Ext.lang.akshar.n91[Ext.lang.global.langId];
        }else if(num==92){
            return Ext.lang.akshar.n92[Ext.lang.global.langId];
        }else if(num==93){
            return Ext.lang.akshar.n93[Ext.lang.global.langId];
        }else if(num==94){
            return Ext.lang.akshar.n94[Ext.lang.global.langId];
        }else if(num==95){
            return Ext.lang.akshar.n95[Ext.lang.global.langId];
        }else if(num==96){
            return Ext.lang.akshar.n96[Ext.lang.global.langId];
        }else if(num==97){
            return Ext.lang.akshar.n97[Ext.lang.global.langId];
        }else if(num==98){
            return Ext.lang.akshar.n98[Ext.lang.global.langId];
        }else if(num==99){
            return Ext.lang.akshar.n99[Ext.lang.global.langId];
        }
    },
    getAmountUnit:function(v,unit){
        if (v>0){
            if(unit=="kharab"){
                return this.getAkshar(v) + Ext.lang.amountUnit.kharab[Ext.lang.global.langId];
            }else if(unit=="arab"){
                return this.getAkshar(v) + Ext.lang.amountUnit.arab[Ext.lang.global.langId];
            }else if(unit == "karor"){
                return this.getAkshar(v) + Ext.lang.amountUnit.karor[Ext.lang.global.langId];
            }else if(unit == "lakh"){
                return this.getAkshar(v) + Ext.lang.amountUnit.lakh[Ext.lang.global.langId];
            }else if(unit == "hajar"){
                return this.getAkshar(v) + Ext.lang.amountUnit.hajar[Ext.lang.global.langId];
            }else if(unit == "saya"){
                return this.getAkshar(v) + Ext.lang.amountUnit.saya[Ext.lang.global.langId];
            }else if(unit == "rupaiya"){
                return this.getAkshar(v) + Ext.lang.amountUnit.rupaiya[Ext.lang.global.langId];
            }else if(unit == "paisa"){
                return this.getAkshar(v) + Ext.lang.amountUnit.paisa[Ext.lang.global.langId];
            }
        }else{
            return "";
        }
    },
    getInWords:function(amount){
        var inWords="";
        var kharab=0;
        var arab=0;
        var karor=0;
        var lakh=0;
        var hajar=0;
        var saya=0;
        var rupaiya=0;
        var paisa=0;
        var word ="";
        var d = amount-parseInt(amount);
        if (d>0){
            paisa= parseInt(d*100);
        }
        amount = parseInt(amount);
        if(amount>=100000000000){
            kharab = parseInt(amount/10000000000);
            amount = amount%10000000000;            
        }
        if(amount>=1000000000){
            arab = parseInt(amount/1000000000);
            amount = amount%1000000000;            
        }
        if(amount>=10000000){
            karor = parseInt(amount/10000000);
            amount = amount%10000000;            
        }
        if(amount>=100000){
            lakh = parseInt(amount/100000);
            amount = amount%100000;            
        }
        if(amount>=1000){
            hajar = parseInt(amount/1000);
            amount = amount%1000;            
        }
        if(amount>=100){
            saya = parseInt(amount/100);
            rupaiya = amount%100
        }else{
            rupaiya = amount;
        }
        word = ""+ this.getAmountUnit(kharab,"kharab");
        word = word + this.getAmountUnit(arab,"arab");
        word = word + this.getAmountUnit(lakh,"lakh");
        word = word + this.getAmountUnit(hajar,"hajar");
        word = word + this.getAmountUnit(saya,"saya");
        word = word + this.getAmountUnit(rupaiya,"rupaiya");
        word = word + this.getAmountUnit(paisa,"paisa")+" "+Ext.lang.global.only[Ext.lang.global.langId];
        return word; 
    }
});