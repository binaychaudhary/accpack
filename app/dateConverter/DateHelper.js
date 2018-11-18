Ext.define('ExtMVC.dateConverter.DateHelper', {
    alternateClassName: ['DateHelper'],
    requires: [
        'ExtMVC.dateConverter.NepaliDate',
        'ExtMVC.dateConverter.DateMap'
        // 'ExtMVC.dateConverter.AdToBsPicker',
        // 'ExtMVC.dateConverter.BsToAdPicker'
       // 'ExtMVC.SessionData'
    ],
    _engIndex: {},
    _nepIndex: {},
    fullData: null,
    constructor: function(config) {
        var me = this,
            datemap1 = new ExtMVC.dateConverter.DateMap();
        datemapdata = datemap1.date_map;
        me.fullData = datemapdata();
        var i = 0;
        for (i = 0; i < me.fullData.length; i++) {
            var nd = me.fullData[i][0];
            var ed = me.fullData[i][1];
            me._nepIndex[nd.substr(0, 7)] = i;
            me._engIndex[ed.substr(0, 7)] = i;
        }
    },
    ConvertAdToBs: function(date_ad, date_format) {
        var date_bs;
        var user_date_ad, //date_ad
            subString;
        if (Ext.isString(date_ad)) {
            if (Ext.isEmpty(date_format)) {
                date_format = "Y/d/m";
            }
            date_ad = Ext.Date.parse(date_ad, date_format);
        }
        if (Ext.isDate(date_ad)) {
            user_date_ad = Ext.Date.format(date_ad, "Y/m/d");
            subString = user_date_ad.substr(0, 7);
            var me = this;
            if (me._engIndex.hasOwnProperty(subString)) {
                var adcsv_dateRow = me.fullData[me._engIndex[subString]],
                    adcsv_date_bs = adcsv_dateRow[0];
                adcsv_date_bs = new NepaliDate(adcsv_date_bs);
                var user_date_ad_array = user_date_ad.split("/"),
                    user_date_ad_days = user_date_ad_array[2],
                    csv_date_ad_days = adcsv_dateRow[1].split("/")[2];
                if (user_date_ad_days >= csv_date_ad_days) {
                    adcsv_date_bs.addDays(parseInt(user_date_ad_days) - parseInt(csv_date_ad_days));

                    date_bs = adcsv_date_bs.format();
                    return date_bs;
                } else {
                    var adcsv_dateRow1 = me.fullData[(me._engIndex[subString]) - 1],
                        adcsv_date_bs1 = adcsv_dateRow1[0];
                    adcsv_date_bs1 = new NepaliDate(adcsv_date_bs1);
                    prev_month_tot_days = adcsv_dateRow1[2];
                    adcsv_dateRow1 = me.fullData[me._engIndex[subString]];
                    ad_start_day = adcsv_dateRow1[1].split("/")[2];
                    user_date_ad_days1 = user_date_ad.split("/")[2];
                    adcsv_date_bs1.addDays(parseInt(prev_month_tot_days) - (parseInt(ad_start_day) - parseInt(user_date_ad_days1)));
                    date_bs = adcsv_date_bs1.format();
                    return date_bs;
                }
            }
        } else {
            Ext.Msg.alert("Invalid AD date.");
            return false;
        }
    },
    //bs to ad
    ConvertBsToAd: function(date_bs, date_format) {
         var me = this,
            date_ad;
        //user_date_ad; //date_ad
        if (Ext.isString(date_bs)) {
            if (Ext.isEmpty(date_format)) {
                date_format = "Y/m/d";
            }
            var tmp = date_bs;
            date_bs = new NepaliDate(tmp);
        }
        if (Ext.getClass(date_bs).$className == "ExtMVC.dateConverter.NepaliDate") {
            var subString = date_bs.format().substring(0, 7);
            if (me._nepIndex.hasOwnProperty(subString)) {
                var dateRow = me.fullData[me._nepIndex[subString]],
                    days_bs = date_bs.day; ///date_bs_array[2],
                date_ad = Ext.Date.add(new Date(dateRow[1]), Ext.Date.DAY, days_bs - 1);
                date_ad.getDate(days_bs - 1);
                var year = date_ad.getFullYear(),
                month = ('00' + (date_ad.getMonth() + 1)).slice(-2),
                day = ('00' + date_ad.getDate()).slice(-2);
                date_ad = year + "/" + month + "/" + day;
            }
            if (date_ad) {
                    return date_ad;
            } else {
                Ext.Msg.alert("Invalie", 'Invalid Date');
                return false;
            }
        }
    },
    //getMonth last date
    GetMonthLastDateBs: function(year, month) {
         var me = this;
        var last_date_bs;
        var subString = year + "/"+month;
        if (me._nepIndex.hasOwnProperty(subString)) {
            var dateRow = me.fullData[me._nepIndex[subString]],
                days_bs = date_bs_array[2];
                last_date_bs = year + "/"+month+"/"+days_bs;
                
        }
        return date_bs;
    },
    ConvertBsToAdwithoutfuture: function(date_bs, date_format) {
        var me = this,
            date_ad,
            user_date_ad; //date_ad
        if (Ext.isString(date_bs)) {
            if (Ext.isEmpty(date_format)) {
                date_format = "Y/d/m";
            }
            var tmp = date_bs;
            date_bs = new NepaliDate(tmp);
        }
        if (Ext.getClass(date_bs).$className == "ExtMVC.dateConverter.NepaliDate") {
            var subString = date_bs.format().substring(0, 7);
            if (me._nepIndex.hasOwnProperty(subString)) {
                var dateRow = me.fullData[me._nepIndex[subString]],
                    days_bs = date_bs.day; ///date_bs_array[2],
                date_ad = Ext.Date.add(new Date(dateRow[1]), Ext.Date.DAY, days_bs - 1); //changed  days_bs - 1 to days_bs
                date_ad.getDate(days_bs - 1);
                var year = date_ad.getFullYear(),
                    month = ('00' + (date_ad.getMonth() + 1)).slice(-2),
                    day = ('00' + date_ad.getDate()).slice(-2);
                date_ad = year + "/" + month + "/" + day;
            }
            if (date_ad) {
                return date_ad;
            } else {
                Ext.Msg.alert(Ext.lang.global.appname, Ext.lang.global.format_date_error_msg);
            }
        }
    }
    // AutoConvertBetweenAdBs: function(date_ad_field, date_bs_field) {
    //     var me = this;
    //     if (Ext.getClass(date_ad_field).superclass.self.getName() != "Ext.form.field.Date") {
    //         Ext.raise("Invalid AD Date control. Must be object of Ext.form.field.Date");
    //         return false;
    //     }
    //     if (Ext.getClass(date_ad_field).$className != "ExtMVC.dateConverter.AdToBsPicker") {
    //         Ext.raise("Invalid BS Date control. Must be object of ExtMVC.dateConverter.AdToBsPicker");
    //         return false;
    //     }
    //     date_ad_field.on('blur', function() {
    //         date_bs_field.setValue(me.ConvertAdToBs(date_ad_field.getValue()));
    //     });
    //     date_bs_field.on('blur', function() {
    //         var futuredateprop = this.futuredate;
    //         //ftrprop = futuredateprop.futuredate;
    //         if (futuredateprop == 'unchecked') {
    //             var withoutfuturedatead = me.ConvertBsToAdwithoutfuture(date_bs_field.getValue());
    //             date_ad_field.setValue(withoutfuturedatead);
    //         } else {
    //             var datead = me.ConvertBsToAd(date_bs_field.getValue());
    //             if (datead === undefined) {
    //                 date_bs_field.setValue(null);
    //             }
    //             date_ad_field.setValue(datead);
    //         }
    //     });
    // }
});