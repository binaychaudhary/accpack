<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['accountnos'];

	$data = json_decode($info);
	//$structureId=$data->structureId;
	$accountNo=$data->accountNo;
	$accountDesc=$data->accountDesc;
	$account = $data->accountDesc;
	$address=$data->address;
	$contactNo=$data->contactNo;
	$email=$data->email;
	$openingBalance=$data->openingBalance;
	$status=$data->status;
	$ac_group =$data->ac_group;
	
	

	// $accountNo=$_REQUEST['accountNo'];
	// $accountDesc=$_REQUEST['accountDesc'];
	// $account = $accountDesc;
	// $address=$_REQUEST['address'];
	// $contactNo=$_REQUEST['contactNo'];
	// $email=$_REQUEST['email'];
	// $openingBalance=$_REQUEST['openingBalance'];
	// $status=$_REQUEST['status'];
	// $ac_group =$_REQUEST['ac_group'];


	if(is_null($openingBalance)){
		$openingBalance=0;
	}

	$accountArray = explode('-',$accountNo);
	$ac_code = $accountArray[count($accountArray)-1];

	$resp=true;
	$respMsg="";

	
	$groupSql ="select * from ac_group where id='".$ac_group."'";
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

	if(is_null($g1)){
		$g1	=0;
	}
	if(is_null($g2)){
		$g2	=0;
	}
	if(is_null($g3)){
		$g3	=0;
	}
	if(is_null($g4)){
		$g4	=0;
	}
	if(is_null($g5)){
		$g5	=0;
	}

	$rsacnature=$conn->query("select * from acnature where id='".$natureId."'");
	$r=mysqli_fetch_assoc($rsacnature);
	$nature=$r['nature'];
	
	//consulta sql
	$query = sprintf("INSERT INTO acmaster (natureId, status, accountNo, accountDesc, address, contactNo, email, openingBalance, ac_group, g1, g2, g3, g4, g5, ac_code) values ('%d','%d','%s','%s','%s','%s','%s','%d','%d','%d','%d','%d','%d','%d','%d')",
		$conn->real_escape_string($natureId),
		$conn->real_escape_string($status),
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($accountDesc),
		$conn->real_escape_string($address),
		$conn->real_escape_string($contactNo),
		$conn->real_escape_string($email),
		$conn->real_escape_string($openingBalance),
		$ac_group,
		$g1,
		$g2,
		$g3,
		$g4,
		$g5,
		$ac_code
	);

	$rs = $conn->query($query);

	$id= mysqli_insert_id($conn);
	$resp=mysqli_connect_error();
	$respMsg="Data Inserted Successfully";

	
	

	if($openingBalance<>0){

		//working for entry part
		//reading fiscalyear
		$rsFiscalYear=$conn->query("select * from fiscalyear where status='1' order by id");
		$r=mysqli_fetch_assoc($rsFiscalYear);
		$fiscalyear=$r['fiscalyear'];
		$start_date_bs=$r['start_date_bs'];
		$start_date_ad=$r['start_date_ad'];

		//reading sourcecode
		$rsSourceCode=$conn->query("select * from sourcecode where categoryId=1");
		$r=mysqli_fetch_assoc($rsSourceCode);
		$sourceCodeId=$r['id'];
		$codeLength=$r['codeLength'];
		$entryNo=substr("00000000001",-$codeLength);


		if (($natureId==1)||($natureId==4)){
			$debit=$openingBalance;
			$credit=0;
		}else if (($natureId==2)||($natureId==3)){
			$debit=0;
			$credit=$openingBalance;
		}
		$narration="Opening Balance";
		
		//inserting in entry 
		// $qry="insert into entry(fiscalyear";
		// $qry=$qry.", sourceCodeId";
		// $qry=$qry.", accountNo";
		// $qry=$qry.", entryNo";
		// $qry=$qry.", entry_date_bs";
		// $qry=$qry.", entry_date_ad";
		// $qry=$qry.", debit";
		// $qry=$qry.", credit";
		// $qry=$qry.", collectorId";
		// $qry=$qry.", narration";
		// $qry=$qry.", approvalStatus)";
		
		// $qry=$qry." values('".$fiscalyear."'";
		// $qry=$qry.",'". $sourceCodeId."'";
		// $qry=$qry.",'". $accountNo."'";
		// $qry=$qry.",'". $entryNo."'";
		// $qry=$qry.",'". $start_date_bs."'";
		// $qry=$qry.",'". date('Y-m-d',strtotime($start_date_ad))."'";
		// $qry=$qry.",". $debit."";
		// $qry=$qry.",". $credit."";
		// $qry=$qry.",'1'";
		// $qry=$qry.",'". $narration."'";
		// $qry=$qry.",'1')";
		// //mysql_query($qry);

		//inserting in entry 
		$qry="insert into tmpentry(fiscalyear";
		$qry=$qry.", sourceCodeId";
		$qry=$qry.", accountNo";
		$qry =$qry.", account";
		$qry=$qry.", entryNo";
		$qry=$qry.", entry_date_bs";
		$qry=$qry.", entry_date_ad";
		$qry=$qry.", debit";
		$qry=$qry.", credit";
		$qry=$qry.", collectorId";
		$qry=$qry.", narration";
		$qry=$qry.", approvalStatus,  natureId, ac_group, g1, g2, g3, g4, g5)";
		
		$qry=$qry." values('".$fiscalyear."'";
		$qry=$qry.",'". $sourceCodeId."'";
		$qry=$qry.",'". $accountNo."'";
		$qry=$qry.",'". $account."'";
		$qry=$qry.",'". $entryNo."'";
		$qry=$qry.",'". $start_date_bs."'";
		$qry=$qry.",'". date('Y-m-d',strtotime($start_date_ad))."'";
		$qry=$qry.",". $debit."";
		$qry=$qry.",". $credit."";
		$qry=$qry.",'1'";
		$qry=$qry.",'". $narration."'";
		$qry=$qry.",'1'";
		$qry=$qry.",'".$natureId."'";
		$qry=$qry.",'".$ac_group."'";
		$qry=$qry.",'".$g1."'";
		$qry=$qry.",'".$g2."'";
		$qry=$qry.",'".$g3."'";
		$qry=$qry.",'".$g4."'";
		$qry=$qry.",'".$g5."')";
		$conn->query($qry);
	} //if opening balance is nor zero

	echo $qry;
	
	//end of segment list and length list
	echo json_encode(array(
		"success" => $resp == 0,
		"message"=>$respMsg,
		"accountnos" => array(
			"id" => $id,
			"accountNo"=>$accountNo,
			"accountDesc"=>$accountDesc,
			"account"=>$account,
			"address"=>$address,
			"contactNo"=>$contactNo,
			"email"=>$email,
			"openingBalance"=>$openingBalance,
			"status"=>$status,
			"nature"=>$nature,
			"ac_group"=>$ac_group,
			"ac_group_desc" => $ac_group_desc,
			"group_name" => $ac_group_desc,
			"g1"=>$g1,
			"g2"=>$g2,
			"g3"=>$g3,
			"g4"=>$g4,
			"g5"=>$g5,
			//"qry" =>$query
		)
	));
?>