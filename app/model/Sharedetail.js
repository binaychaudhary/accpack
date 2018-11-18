Ext.define('ExtMVC.model.Sharedetail', {
    extend: 'Ext.data.Model',
    fields: ['id','accountNo','accountDesc','grand_father', 'father_name', 'temp_state', 'temp_district','temp_vdc_mpc','temp_ward_no','perm_state', 'perm_district','perm_vdc_mpc','perm_ward_no','contact_no','email_address','gender','birth_date','marital_status','nom_name','nom_relation']
});