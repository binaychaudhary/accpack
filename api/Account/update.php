<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$conn->query("SET NAMES utf8");  
	// $info = $_POST['accountnos'];

	// $data = json_decode($info);
	// $id = $data->id;
	// $accountNo=$data->accountNo;
	// $accountDesc=$data->accountDesc;
	// $account = $accountDesc;
	// $address=$data->address;
	// $contactNo=$data->contactNo;
	// $email=$data->email;
	// $openingBalance=$data->openingBalance;
	// $status=$data->status;
	// $ac_group =$data->ac_group;
	$id=$_REQUEST['id'];
	$accountNo=$_REQUEST['accountNo'];
	$ac_group=$_REQUEST['ac_group'];
	$accountDesc=$_REQUEST['accountDesc'];
	$account = $_REQUEST['accountDesc'];
	$address=$_REQUEST['address'];
	$contactNo=$_REQUEST['contactNo'];
	$email=$_REQUEST['email'];
	$openingBalance=$_REQUEST['openingBalance'];
	$status=$_REQUEST['status'];


	$accountArray = explode('-',$accountNo);

	$ac_code = $accountArray[count($accountArray)-1];
	

	
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
	//echo "<br>response ".$resp;
		//consulta sql
		$query = sprintf("update acmaster set natureId='%d',  status='%d',accountNo='%s', accountDesc='%s', address='%s', contactNo='%s', email='%s', openingBalance='%d', ac_group='%d', g1='%d', g2='%d', g3='%d', g4='%d', g5='%d', ac_code='%d'  where id='%d'",
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
			$ac_code,
			$id
		);

		$rs = $conn->query($query);

		//update ac_group, g1, g2, g3, g4, g5 to tmpentry
		$sql = "update tmpentry set ac_group='$ac_group', g1='$g1', g2='$g2', g3='$g3', g4='$g4', g5='$g5' where accountNo='$accountNo'";
		$conn->query($sql);
		//echo $query;
		// $updateQry="update acmaster set ".$updateCr." where id='".$id."'";
		// $conn->query($updateQry);
		// $resp=$conn->error();
		// $respMsg="Data Updated Successfully";


		$rsFiscalYear=$conn->query("select * from fiscalyear where status='1' order by id");
		$r=mysqli_fetch_assoc($rsFiscalYear);
		$fiscalyear=$r['fiscalyear'];
		$start_date_bs=$r['start_date_bs'];
		$start_date_ad=$r['start_date_ad'];

		//echo "fiscalyear ".$fiscalyear;

		//reading sourcecode
		$rsSourceCode=$conn->query("select * from sourcecode where categoryId=1");
		$r=mysqli_fetch_assoc($rsSourceCode);
		$sourceCodeId=$r['id'];
		$codeLength=$r['codeLength'];
		$entryNo=substr("00000000001",-$codeLength);

		//echo "<br> entry no : ".$entryNo;
		if (($natureId==1)||($natureId==4)){
			$debit=$openingBalance;
			$credit=0;
		}else if (($natureId==2)||($natureId==3)){
			$debit=0;
			$credit=$openingBalance;
		}
		$narration="Opening Balance";
		
		if(($openingBalance==0) || (is_null($openingBalance))){
			$qry="delete from tmpentry where fiscalyear='".$fiscalyear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."' and accountNo='".$id."'";
		}else if($openingBalance<>0){
			$rs=$conn->query("select * from tmpentry where fiscalyear='".$fiscalyear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."' and accountNo='".$id."'");
			if(mysqli_num_rows($rs)>0){
				$qry="update tmpentry set debit=".$debit.", credit=".$credit." where fiscalyear='".$fiscalyear."' and sourceCodeId='".$sourceCodeId."' and entryNo='".$entryNo."' and accountNo='".$id."'";
			}else{
				//inserting in entry 
			$qry="insert into tmpentry(fiscalyear";
			$qry=$qry.", sourceCodeId";
			$qry=$qry.", accountNo";
			$qry=$qry.", entryNo";
			$qry=$qry.", entry_date_bs";
			$qry=$qry.", entry_date_ad";
			$qry=$qry.", debit";
			$qry=$qry.", credit";
			$qry=$qry.", collectorId";
			$qry=$qry.", narration";
			$qry=$qry.", approvalStatus, ac_group, g1, g2, g3, g4, g5, natureId)";
			
			$qry=$qry." values('".$fiscalyear."'";
			$qry=$qry.",'". $sourceCodeId."'";
			$qry=$qry.",'". $accountNo."'";
			$qry=$qry.",'". $entryNo."'";
			$qry=$qry.",'". $start_date_bs."'";
			$qry=$qry.",'". date('Y-m-d',strtotime($start_date_ad))."'";
			$qry=$qry.",". $debit."";
			$qry=$qry.",". $credit."";
			$qry=$qry.",'1'";
			$qry=$qry.",'". $narration."'";
			$qry=$qry.",'1'";
			$qry=$qry.",'".$ac_group."'";
			$qry=$qry.",'".$g1."'";
			$qry=$qry.",'".$g2."'";
			$qry=$qry.",'".$g3."'";
			$qry=$qry.",'".$g4."'";
			$qry=$qry.",'".$g5."'";
			$qry=$qry.",'".$natureId."')";
			}
		}
		//echo "<br>query ".$qry;
		$conn->query($qry);

		$resp=mysqli_connect_error();
		$respMsg="Data Inserted Successfully";

	//}

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
			"natureId"=>$natureId,
			"ac_group"=>$ac_group,
			"ac_group_desc" => $ac_group_desc,
			"group_name" => $ac_group_desc,
			"g1"=>$g1,
			"g2"=>$g2,
			"g3"=>$g3,
			"g4"=>$g4,
			"g5"=>$g5
		)
	));
?>