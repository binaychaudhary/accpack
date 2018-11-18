<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	//sql_query("SET NAMES utf8");  
	$info = $_POST['sharedetails'];

	$data = json_decode($info);
	$id = $data->id;
	$accountNo = $data->accountNo;
	$grand_father = $data->grand_father;
	$father_name = $data->father_name;
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
	
	$res=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$rs=mysqli_fetch_assoc($res);
	$accountDesc=$rs['accountDesc'];

	//consulta sql
	$query = sprintf("UPDATE sharedetail SET accountNo = '%s',grand_father = '%s', father_name='%s', temp_state = '%s', temp_district = '%s', temp_vdc_mpc = '%s', temp_ward_no = '%d', perm_state = '%s', perm_district = '%s', perm_vdc_mpc = '%s', perm_ward_no = '%d', contact_no = '%s', email_address = '%s', gender = '%d', birth_date = '%s', marital_status = '%d', nom_name = '%s', nom_relation = '%s' WHERE id=%d",
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($grand_father),
		$conn->real_escape_string($father_name),
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
		$conn->real_escape_string($nom_relation),
		$conn->real_escape_string($id));
	
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sharedetails" => array(
		"id" => $id,
		"accountNo"=>$accountNo,
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