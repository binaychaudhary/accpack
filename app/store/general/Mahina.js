Ext.define('ExtMVC.store.general.Mahina', {
   extend: 'Ext.data.Store',
    alias: 'store.mahina',
    fields: ['id','mahinaId', 'Mahina'],
    data: [{
        "id":"1",
        "mahinaId": "01",
        "Mahina": "बैशाख"
    },{
        "id":"2",
        "mahinaId": "02",
        "Mahina": "जेष्ठ"
    },{
        "id":"3",
        "mahinaId": "03",
        "Mahina": "अाषाढ"
    },{
        "id":"4",
        "mahinaId": "04",
        "Mahina": "श्रावण"
    },{
        "id":"5",
        "mahinaId": "05",
        "Mahina": "भाद्र"
    },{
        "id":"6",
        "mahinaId": "06",
        "Mahina": "आश्विन"
    },{
        "id":"7",
        "mahinaId": "07",
        "Mahina": "कार्तिक"
    },{
        "id":"8",
        "mahinaId": "08",
        "Mahina": "मंग्सिर"
    },{
        "id":"9",
        "mahinaId": "09",
        "Mahina": "पौष"
    },{
        "id":"10",
        "mahinaId": "10",
        "Mahina": "माघ"
    },{
        "id":"11",
        "mahinaId": "11",
        "Mahina": "फाल्गुण"
    },{
        "id":"12",
        "mahinaId": "12",
        "Mahina": "चैत्र"
    }],
    proxy: {
        type: 'memory'
    }
});