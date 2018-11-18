<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['consumers'];

	$data = json_decode($info);
	$id=$data->id;
	$consumer_name = $data->consumer_name;
	$sex = $data->sex;
	$contactNo = $data->contactNo;
	$email = $data->email;
	$father_name = $data->father_name;
	$grand_father_name = $data->grand_father_name;
	$occupation = $data->occupation;
	$citizenship_no = $data->citizenship_no;
	$citi_issued_district = $data->citi_issued_district;
	$citi_issued_date = $data->citi_issued_date;
	$voter_id = $data->voter_id;
	$house_no = $data->house_no;
	$prv_district = $data->prv_district;
	$prv_vdc_mpc = $data->prv_vdc_mpc;
	$prv_ward_no = $data->prv_ward_no;
	$cur_district = $data->cur_district;
	$cur_vdc_mpc = $data->cur_vdc_mpc;
	$cur_ward_no = $data->cur_ward_no;
	$marg_tole = $data->marg_tole;
	$local_migrated_id = $data->local_migrated_id;
	$consumer_type_id = $data->consumer_type_id;
	$meter_no = $data->meter_no;
	$membership_date_bs = $data->membership_date_bs;
	$membership_date_ad = $data->membership_date_ad;
	$status=$data->status;
	//consulta sql
	$query = sprintf("UPDATE consumer SET status='%d', membership_date_ad='%s', membership_date_bs='%s',  meter_no='%s', consumer_type_id='%d', local_migrated_id='%d', marg_tole='%s', cur_ward_no='%d', cur_vdc_mpc='%s', cur_district='%s', prv_ward_no = '%d', prv_vdc_mpc='%s', prv_district='%s', house_no='%s', voter_id ='%s' , citi_issued_date ='%s',citi_issued_district='%s', citizenship_no ='%s', occupation ='%s',  grand_father_name='%s', consumer_name = '%s', sex='%d', contactNo='%s', email='%s', father_name='%s' WHERE id=%d",
		$conn->real_escape_string($status),
		$conn->real_escape_string($membership_date_ad),
		$conn->real_escape_string($membership_date_bs),
		$conn->real_escape_string($meter_no),
		$conn->real_escape_string($consumer_type_id),
		$conn->real_escape_string($local_migrated_id),
		$conn->real_escape_string($marg_tole),
		$conn->real_escape_string($cur_ward_no),
		$conn->real_escape_string($cur_vdc_mpc),
		$conn->real_escape_string($cur_district),
		$conn->real_escape_string($prv_ward_no),
		$conn->real_escape_string($prv_vdc_mpc),
		$conn->real_escape_string($prv_district),
		$conn->real_escape_string($house_no),
		$conn->real_escape_string($voter_id),
		$conn->real_escape_string($citi_issued_date),
		$conn->real_escape_string($citi_issued_district),
		$conn->real_escape_string($citizenship_no),
		$conn->real_escape_string($occupation),
		$conn->real_escape_string($grand_father_name),
		$conn->real_escape_string($consumer_name),
		$conn->real_escape_string($sex),
		$conn->real_escape_string($contactNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($father_name),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"consumers" => array(
			"id" => $id,
			"consumer_name" => $consumer_name,
			"sex" => $sex,
			"email" => $email,
			"father_name" => $father_name,
			"grand_father_name" => $grand_father_name,
			"occupation" => $occupation,
			"citizenship_no" => $citizenship_no,
			"citi_issued_district" => $citi_issued_district,
			"citi_issued_date" => $citi_issued_date,
			"voter_id" => $voter_id,
			"house_no" => $house_no,
			"prv_district" => $prv_district,
			"prv_vdc_mpc" => $prv_vdc_mpc,
			"prv_ward_no" => $prv_ward_no,
			"cur_district" => $cur_district,
			"cur_vdc_mpc" => $cur_vdc_mpc,
			"cur_ward_no" => $cur_ward_no,
			"marg_tole" => $marg_tole,
			"local_migrated_id" => $local_migrated_id,
			"consumer_type_id" => $consumer_type_id,
			"meter_no" => $meter_no,
			"status" => $status,
			"membership_date_ad" => $membership_date_ad,
			"membership_date_bs" => $membership_date_bs,
		)
	));
?>