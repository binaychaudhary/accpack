<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['consumers'];

	$data = json_decode($info);
	
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
	$query = sprintf("INSERT INTO consumer (consumer_name, sex, contactNo, email, father_name, grand_father_name, occupation, citizenship_no, citi_issued_district, citi_issued_date, voter_id, house_no,  prv_district, prv_vdc_mpc, prv_ward_no, cur_district, cur_vdc_mpc, cur_ward_no, marg_tole, local_migrated_id, consumer_type_id, meter_no, status, membership_date_bs, membership_date_ad) values ('%s','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s','%d','%s','%d','%d','%s','%d','%s','%s')",
		$conn->real_escape_string($consumer_name),
		$conn->real_escape_string($sex),
		$conn->real_escape_string($contactNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($father_name),
		$conn->real_escape_string($grand_father_name),
		$conn->real_escape_string($occupation),
		$conn->real_escape_string($citizenship_no),
		$conn->real_escape_string($citi_issued_district),
		$conn->real_escape_string($citi_issued_date),
		$conn->real_escape_string($voter_id),
		$conn->real_escape_string($house_no),
		$conn->real_escape_string($prv_district),
		$conn->real_escape_string($prv_vdc_mpc),
		$conn->real_escape_string($prv_ward_no),
		$conn->real_escape_string($cur_district),
		$conn->real_escape_string($cur_vdc_mpc),
		$conn->real_escape_string($cur_ward_no),
		$conn->real_escape_string($marg_tole),
		$conn->real_escape_string($local_migrated_id),
		$conn->real_escape_string($consumer_type_id),
		$conn->real_escape_string($meter_no),
		$conn->real_escape_string($status),
		$conn->real_escape_string($membership_date_bs),
		$conn->real_escape_string($membership_date_ad) 
	);

	$rs = $conn->query($query);
	$inser_id = mysqli_insert_id($conn);
	$acGroup='28';
	$groupSql ="select * from ac_group where id='".$acGroup."'";
	$groupRs = $conn->query($groupSql);
	$r = mysqli_fetch_assoc($groupRs);
	$ac_group_name = $r['group_name'];
	$g1 = $r['g1'];
	$g2= $r['g2'];
	$g3= $r['g3'];
	$g4= $r['g4'];
	$g5 =$r['g5'];
	$ac_group_desc=$r['group_name'];
	$natureId=$r['ac_nature'];

	$ac_prefix = $r['ac_prefix'];
	$acpre = explode('-', $ac_prefix);
	//echo $acpre[1];
	$acLength = strlen($acpre[1]);
	//echo $acLength;
	$rsacnature=$conn->query("select * from acnature where id='".$natureId."'");
	$r=mysqli_fetch_assoc($rsacnature);
	$nature=$r['nature'];

	
	//finding last ac_code from acmaster
	$lastAcCodeSql = "select * from acmaster where ac_group='".$acGroup."' order by id desc limit 1";
	//echo $lastAcCodeSql;
	$rs = $conn->query($lastAcCodeSql);
	$ac_code=0;
	$newAccountNo="";
	if(mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$lastAcCode = $r['ac_code'];
		$ac_code=$lastAcCode+1;
		//echo $ac_code;
		$newAcCode = "00000000000000".$ac_code;
		$newAcCode = substr($newAcCode,-$acLength);
		$newAccountNo = $acpre[0].'-'.$newAcCode;		
	}

	//address
	$address="";
	if($cur_vdc_mpc==""){
	}else{
		$address = $cur_vdc_mpc;
	}
	if($cur_ward_no==""){
	}else{
		if(is_null($address) || ($address=="")){
			$address = $cur_ward_no;	
		}else{
			$address= $address."-".$cur_ward_no;
		}		
	}
	if($cur_district==""){
	}else{
		if(is_null($address) || ($address=="")){
			$address = $cur_district;	
		}else{
			$address= $address.", ".$cur_district;
		}		
	}
	//consulta sql
	$openingBalance=0;
	$query = sprintf("INSERT INTO acmaster (natureId, status, accountNo, accountDesc, address, contactNo, email, openingBalance, ac_group, g1, g2, g3, g4, g5, ac_code) values ('%d','%d','%s','%s','%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d')",
		$conn->real_escape_string($natureId),
		$conn->real_escape_string($status),
		$conn->real_escape_string($newAccountNo),
		$conn->real_escape_string($consumer_name),
		$conn->real_escape_string($address),
		$conn->real_escape_string($contactNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($openingBalance),
		$acGroup,
		$g1,
		$g2,
		$g3,
		$g4,
		$g5,
		$ac_code
	);

	$conn->query($query);
	$updateAcNo ="update consumer set accountNo ='".$newAccountNo."' where id='".$inser_id."'";
	$conn->query($updateAcNo);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"consumers" => array(
			"id" => $inser_id,
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
			"accountNo" => $newAccountNo
		)
	));
?>