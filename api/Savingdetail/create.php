<?php
	//chama o arquivo de conex�o com o bd
	include("../../includes/conectar.php");

	$info = $_POST['savingdetails'];

	$data = json_decode($info);
	
	$accountNo = $data->accountNo;
	$shareAcNo = $data->shareAcNo;
	$accountTypeId=$data->accountTypeId;
	$acCategoryId=$data->acCategoryId;
	//$recomender_id=$data->recomender_id;
	$approver_id=$data->approver_id;
	$collector_id=$data->collector_id;
	$mature_type_id	=$data->mature_type_id;
	$start_date_bs=$data->start_date_bs;
	$start_date_ad=$data->start_date_ad;
	$mature_date_bs = $data->mature_date_bs;
	$mature_date_ad = $data->mature_date_bs;
	$smsAlert=$data->smsAlert;
	$minBalance=$data->minBalance;
	$ebanking= $data->ebanking;
	$status = $data->status;

	$hw_id = $data->hw_id;
	$hw_name = $data->hw_name;
	$grand_father = $data->grand_father;
	$father_name = $data->father_name;
	$sex = $data->sex;
	$temp_state = $data->temp_state;
	$temp_district = $data->temp_district;
	$temp_vdc_mpc = $data->temp_vdc_mpc;
	$temp_ward_no = $data->temp_ward_no;
	$perm_state = $data->perm_state;
	$perm_district = $data->perm_district;
	$perm_vdc_mpc = $data->perm_vdc_mpc;
	$perm_ward_no = $data->perm_ward_no;
	$contact_no = $data->contact_no;
	$email_address = $data->email_address;
	$gender = $data->gender;
	$birth_date = $data->birth_date;
	$marital_status = $data->marital_status;
	$nom_name = $data->nom_name;
	$nom_relation = $data->nom_relation;

	//consulta sql

	$rs = $conn->query("SELECT * FROM accategory where id='".$acCategoryId."'");
	$r = mysqli_fetch_assoc($rs);
	$acCategory = $r['acCategory'];

	$rs = $conn->query("select * from matureperiod where id = '".$mature_type_id."'");
	$r = mysqli_fetch_assoc($rs);
	$periodDesc = $r['periodDesc'];	

	$rs = $conn->query("select * from acmaster where accountNo = '".$accountNo."'");
	$r = mysqli_fetch_assoc($rs);
	$accountDesc = $r['accountDesc'];	

	$query = sprintf("INSERT INTO savingacdetail(accountNo, shareAcNo, accountTypeId, acCategoryId,  approver_id, collector_id, mature_type_id,start_date_bs, start_date_ad, mature_date_bs, mature_date_ad, smsAlert, minBalance, ebanking, status) values ('%s','%s','%d','%d','%d','%d','%d','%s','%s','%s','%s','%d','%d','%d','%d','%d','%s','%s','%s','%d','%s','%s','%s','%d','%s','%s','%s','%d','%s','%s','%d','%s','%d','%s','%s')",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($shareAcNo),
		$conn->real_escape_string($accountTypeId),
		$conn->real_escape_string($acCategoryId),
		$conn->real_escape_string($approver_id),
		$conn->real_escape_string($collector_id),
		$conn->real_escape_string($mature_type_id),
		$conn->real_escape_string($start_date_bs),
		$conn->real_escape_string($start_date_ad),
		$conn->real_escape_string($mature_date_bs),
		$conn->real_escape_string($mature_date_ad),
		$conn->real_escape_string($smsAlert),
		$conn->real_escape_string($minBalance),
		$conn->real_escape_string($ebanking),
		$conn->real_escape_string($status),
		$conn->real_escape_string($hw_id),
		$conn->real_escape_string($hw_name),
		$conn->real_escape_string($grand_father),
		$conn->real_escape_string($father_name),
		$conn->real_escape_string($sex),
		$conn->real_escape_string($temp_state),
		$conn->real_escape_string($temp_district),
		$conn->real_escape_string($temp_vdc_mpc),
		$conn->real_escape_string($temp_ward_no),
		$conn->real_escape_string($perm_state),
		$conn->real_escape_string($perm_district),
		$conn->real_escape_string($perm_vdc_mpc),
		$conn->real_escape_string($perm_ward_no),
		$conn->real_escape_string($contact_no),
		$conn->real_escape_string($email_address),
		$conn->real_escape_string($gender),
		$conn->real_escape_string($birth_date),
		$conn->real_escape_string($marital_status),
		$conn->real_escape_string($nom_name),
		$conn->real_escape_string($nom_relation)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		//"qry"=>$query,
		"savingdetails" => array(
			"id"=> mysqli_insert_id($conn),
			"accountNo" => $accountNo,
			"shareAcNo" => $shareAcNo,
			"accountTypeId"=>$accountTypeId,
			"acCategoryId"=>$acCategoryId,
			//"recomender_id"=>$recomender_id,
			"approver_id"=>$approver_id,
			"collector_id"=>$collector_id,
			"mature_type_id"=>$mature_type_id,
			"start_date_bs"=>$start_date_bs,
			"start_date_ad"=>$start_date_ad,
			"mature_date_bs"=>$mature_date_bs,
			"mature_date_ad"=>$mature_date_ad,
			"smsAlert"=>$smsAlert,
			"minBalance"=>$minBalance,
			"ebanking"=>$ebanking,
			"status"=>$status,
			"acCategory"=>$acCategory,
			"periodDesc"=>$periodDesc,
			"accountDesc"=>$accountDesc,
			"grand_father" => $grand_father,
			"father_name" => $father_name,
			"temp_state"=>$temp_state,
			"temp_district"=>$temp_district,
			"temp_vdc_mpc"=>$temp_vdc_mpc,
			"temp_ward_no"=>$temp_ward_no,
			"perm_state"=>$perm_state,
			"perm_district"=>$perm_district,
			"perm_vdc_mpc"=>$perm_vdc_mpc,
			"perm_ward_no"=>$perm_ward_no,
			"contact_no"=>$contact_no,
			"email_address"=>$email_address,
			"gender"=>$gender,
			"birth_date"=>$birth_date,
			"marital_status"=>$marital_status,
			"nom_name"=>$nom_name,
			"nom_relation"=>$nom_relation
		)
	));
?>