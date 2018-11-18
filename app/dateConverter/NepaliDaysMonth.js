Ext.define('ExtMVC.dateConverter.NepaliDaysMonth', {
    itemId: 'NepaliDaysMonth',
    singleton: true,
    nepali_week: function () {
        var fullWeek = [
                        [Ext.lang.nepalidaysmonth.sunday],
                        [Ext.lang.nepalidaysmonth.monday],
                        [Ext.lang.nepalidaysmonth.tuesday],
                        [Ext.lang.nepalidaysmonth.wednesday],
                        [Ext.lang.nepalidaysmonth.thursday],
                        [Ext.lang.nepalidaysmonth.friday],
                        [Ext.lang.nepalidaysmonth.saturday]
                     ];return fullWeek;
    },
    nepali_month:function(){

    	var fullMonth=[
    					[Ext.lang.nepalidaysmonth.january],
                        [Ext.lang.nepalidaysmonth.february],
                        [Ext.lang.nepalidaysmonth.march],
                        [Ext.lang.nepalidaysmonth.april],
                        [Ext.lang.nepalidaysmonth.may],
                        [Ext.lang.nepalidaysmonth.june],
                        [Ext.lang.nepalidaysmonth.july],
                        [Ext.lang.nepalidaysmonth.august],
                        [Ext.lang.nepalidaysmonth.september],
                        [Ext.lang.nepalidaysmonth.october],
                        [Ext.lang.nepalidaysmonth.november],
                        [Ext.lang.nepalidaysmonth.december]
    	];return fullMonth;
    }
});