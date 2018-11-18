Ext.define('ExtMVC.dateConverter.FromToDateValidation', {
	alias: 'widget.fromToDateValidation',
	itemId: 'fromToDateValidation',
	singleton: true,
	require: [
		'ExtMVC.dateConverter.DateHelper'
	],
	fromToDate: function(to_date_ad, to_date_bs, _year_from) {
		var me = this;
		to_date_ad.on('blur', function() {
			//if (to_date_ad.getItemId = 'ad_fiscalyear_Panel_to') {
			me.checkCondition_forAd(to_date_ad, to_date_bs, _year_from);
			//}
		});
		to_date_bs.on('blur', function() {
			//if (to_date_bs.getItemId = 'bs_fiscalyear_Panel_to') {
			me.checkCondition_forBs(to_date_ad, to_date_bs, _year_from);
			//}
		});
	},
	checkCondition_forAd: function(ad_toDateAd, ad_to_date_bs, ad_fromDateAd) {
		var me = this;
		var converter_bs = me.adToBsConverter(ad_toDateAd),
			ad_to_date_ad = new Date(ad_toDateAd.getValue());
		formatted_from_Date_ad = Ext.Date.format(ad_fromDateAd.getValue(), "Y/m/d");
		client_from_date_ad = new Date(formatted_from_Date_ad);
		if (ad_to_date_ad > client_from_date_ad) {
			ad_to_date_bs.setValue(converter_bs);
		} else {
			ad_toDateAd.reset();
			ad_to_date_bs.reset();
			Ext.Msg.alert(Ext.lang.global.appname, Ext.lang.master.general.fiscalYear.fiscalyear_date_to_error);
		}
	},
	checkCondition_forBs: function(bs_toDateAd, bs_to_date_bs, bs_fromDateAd) {
		var me = this;
		var display_ads = me.bsToAdConverter(bs_to_date_bs);
		convert_date_ad_to = new Date(display_ads);
		bs_from_Date_ad = Ext.Date.format(bs_fromDateAd.getValue(), "Y/m/d");
		client_from_date_ad = new Date(bs_from_Date_ad);
		if (convert_date_ad_to > client_from_date_ad) {
			bs_toDateAd.setValue(display_ads);
		} else {
			bs_toDateAd.reset();
			bs_to_date_bs.reset();
			Ext.Msg.alert(Ext.lang.global.appname, Ext.lang.master.general.fiscalYear.fiscalyear_date_to_error);
		}
	},
	adToBsConverter: function(ad_toDateAd) {
		var _adDate = ad_toDateAd.getValue();
		var helper2 = new ExtMVC.dateConverter.DateHelper();
		if (_adDate.length <= 8) {
			var arr = [];
			arr[0] = ad_without_format.substring(0, 4);
			arr[1] = ad_without_format.substring(4, 6);
			arr[2] = ad_without_format.substring(6, 8);
			var date1 = arr.join('/');
			if (ad_toDateAd.futuredate == 'unchecked') {
				bsDate = helper2.ConvertAdToBs(_adDate);
				return bsDate;
			} else {
				var serverdate = SessionData.current_date_ad();
				mydate = new Date(_adDate).setHours(0, 0, 0, 0);
				today = new Date(serverdate).setHours(0, 0, 0, 0);
				if (mydate > today) {
					Ext.Msg.alert(Ext.lang.global.appname, Ext.lang.global.future_date_error_msg);
					me.setValue(null);
					return false;
				} else {
					bsDate = helper2.ConvertAdToBs(_adDate);
					return bsDate;
				}
			}
		} else {
			var bs_with_formatt = helper2.ConvertAdToBs(_adDate);
			return bs_with_formatt;
		}
	},
	bsToAdConverter: function(bs_to_date_bs) {
		var _bsDate = bs_to_date_bs.getValue();
		var helper1 = new ExtMVC.dateConverter.DateHelper();
		if (_bsDate.length <= 8) {
			var arr1 = [];
			arr1[0] = _bsDate.substring(0, 4);
			arr1[1] = _bsDate.substring(4, 6);
			arr1[2] = _bsDate.substring(6, 8);
			var date2 = arr1.join('/');
			if (bs_to_date_bs.futuredate == 'unchecked') {
				var ad_without_future = helper1.ConvertBsToAdwithoutfuture(date2);
				return ad_without_future;
			} else {
				var ad_with_future = helper1.ConvertBsToAd(date2);
				return ad_with_future;
			}
		} else {
			if (bs_to_date_bs.futuredate == 'unchecked') {
				var ad_without_future_formatt = helper1.ConvertBsToAdwithoutfuture(_bsDate);
				return ad_without_future_formatt;
			} else {
				var ad_with_future_formatt = helper1.ConvertBsToAd(_bsDate);
				return ad_with_future_formatt;
			}
		}
	}
});