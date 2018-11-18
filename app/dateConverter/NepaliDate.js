Ext.define('ExtMVC.dateConverter.NepaliDate', {
    alternateClassName: ['NepaliDate'],
    year: 0,
    month: 0,
    day: 0,
    message: "",
    separator: "/",
    constructor: function(date) {
        this.setDate(date);
    },
    setDate: function(date) {
        var me = this;
        if (date.length > 8) {
            var arr2 = [];
            arr2[0] = date.substring(0, 4);
            arr2[1] = date.substring(5, 7);
            arr2[2] = date.substring(8, 10);
            var date2 = arr2.join('/');
            var arr = [];
            arr = date2.split(/[/-]/);
            if (arr.length == 3) {
                if (
                    arr[0].length >= 2 && arr[0].length <= 4 && (arr[1].length == 1 || arr[1].length == 2) && (arr[1] > 0 && arr[1] <= 12) && (arr[2].length == 1 || arr[2].length == 2) && (arr[2] > 0 && arr[2] <= 32)
                ) {
                    me.year = parseInt(arr[0]);
                    if (arr[0].length < 4)
                        me.year = 2000 + parseInt(arr[0]);
                    me.month = parseInt(arr[1]);
                    me.day = parseInt(arr[2]);
                    return true;
                } else {
                    message = "invalid nepali date " + date2;
                }
            } else {
                message = "invalid nepali date " + date2;
            }
            return false;
        } else {
            var arr1 = [];
            arr1[0] = date.substring(0, 4);
            arr1[1] = date.substring(4, 6);
            arr1[2] = date.substring(6, 8);
            var date1 = arr1.join('/');
            var arr = [];
            arr = date1.split(/[/-]/);
            if (arr.length == 3) {
                if (
                    arr[0].length >= 2 && arr[0].length <= 4 && (arr[1].length == 1 || arr[1].length == 2) && (arr[1] > 0 && arr[1] <= 12) && (arr[2].length == 1 || arr[2].length == 2) && (arr[2] > 0 && arr[2] <= 32)
                ) {
                    me.year = parseInt(arr[0]);
                    if (arr[0].length < 4)
                        me.year = 2000 + parseInt(arr[0]);
                    me.month = parseInt(arr[1]);
                    me.day = parseInt(arr[2]);
                    return true;
                } else {
                    message = "invalid nepali date " + date1;
                }
            } else {
                message = "invalid nepali date " + date1;
            }
            return false;
        }
    },
    addDays: function(daysToAdd) {
        this.day = this.day + daysToAdd;
    },
    format: function() {
        var me = this,
            arr = [];
        arr[0] = me.year;
        arr[1] = me.pad(me.month);
        arr[2] = me.pad(me.day);
        return arr.join(me.separator);
    },
    getFullYear: function() {
        return this.year;
    },
    getMonth: function() {
        return this.year;
    },
    pad: function(n) {
        return (n < 10) ? ("0" + n) : n;
    }
});