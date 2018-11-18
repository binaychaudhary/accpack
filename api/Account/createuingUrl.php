<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	// $info = $_POST['accountnos'];

	// $data = json_decode($info);
	// $structureId=$data->structureId;
	// $accountNo=$data->accountNo;
	// $accountDesc=$data->accountDesc;
	// $account = $data->accountNo.'  '.$data->accountDesc;
	// $address=$data->address;
	// $contactNo=$data->contactNo;
	// $email=$data->email;
	// $openingBalance=$data->openingBalance;
	// $status=$data->status;

	$structureId=$_REQUEST['structureId'];
	$accountNo=$_REQUEST['accountNo'];
	$accountDesc=$_REQUEST['accountDesc'];
	$account = $_REQUEST['account'];
	$address=$_REQUEST['address'];
	$contactNo=$_REQUEST['contactNo'];
	$email=$_REQUEST['email'];
	$openingBalance=$_REQUEST['openingBalance'];
	$status=$_REQUEST['status'];

	$segments=array();
	$segLength=array();
	
	$resp=true;
	$respMsg="";

	$supliedSegment=array();
	$supliedSegment=explode("-",$accountNo);
	$subgroup=$supliedSegment[0];
	$rs=$conn->query("select * from structuredef where structureId='".$structureId."'");
	if(mysqli_num_rows($rs)>0){
		$indx=0;
		$updateCr="";
		while ($r=mysqli_fetch_assoc($rs)) {
			$qry="select * from segmentdata where segment_id='".$r['segmentId']."' and segment_code='".$supliedSegment[$indx]."'";
			$res=$conn->query($qry);
			if(mysqli_num_rows($res)<=0){
				$resp=false;
				if($respMsg==""){
					$respMsg="Invalid Code(s): ".$supliedSegment[$indx];
				}else{	
					$respMsg=$respMsg.", ".$supliedSegment[$indx];
				}
			}
			$indx=$indx+1;
			if($updateCr==""){
				$updateCr=" seg".$indx."='".$supliedSegment[$indx-1]."'";
			}else{
				$updateCr=$updateCr.", seg".$indx."='".$supliedSegment[$indx-1]."'";
			}
		}
		
	}
	if($resp){
		$rssubgroup=$conn->query("SELECT * from subgroup where subGroupCode='".$subgroup."'");
		$r=$conn->fetch_assoc($rssubgroup);
		$subgroupId=$r['id'];
		$subgroupDesc=$r['subGroupName'];
		$groupId=$r['groupId'];
		$subGroupCode=$r['subGroupCode'];

		$rsgroup=$conn->query("select * from groups where id='".$groupId."'");
		$r=mysqli_fetch_assoc($rsgroup);
		$natureId=$r['natureId'];
		$groupCode = $r['groupCode'];

		$rsacnature=$conn->query("select * from acnature where id='".$natureId."'");
		$r=mysqli_fetch_assoc($rsacnature);
		$nature=$r['nature'];
		
		//consulta sql
		$query = sprintf("INSERT INTO acmaster (structureId,groupId, subgroupId,natureId, status, accountNo, accountDesc, address, contactNo, email, openingBalance) values ('%d','%d','%d','%d','%d','%s','%s','%s','%s','%s','%d')",
			$conn->real_escape_string($structureId),
			$conn->real_escape_string($groupId),
			$conn->real_escape_string($subgroupId),
			$conn->real_escape_string($natureId),
			$conn->real_escape_string($status),
			$conn->real_escape_string($accountNo),
			$conn->real_escape_string($accountDesc),
			$conn->real_escape_string($address),
			$conn->real_escape_string($contactNo),
			$conn->real_escape_string($email),
			$conn->real_escape_string($openingBalance)
		);

		$rs = $conn->query($query);

		$id= mysqli_insert_id($conn);
		
		$updateQry="update acmaster set ".$updateCr." where id='".$id."'";
		$conn->query($updateQry);

		$resp=mysqli_connect_error();
		$respMsg="Data Inserted Successfully";

		
		

		if($openingBalance<>0){

			//working for entry part
			//reading fiscalyear
			$rsFiscalYear=mysqli_query($conn,"select * from fiscalyear where status='1' order by id");
			$r=mysqli_fetch_assoc($rsFiscalYear);
			$fiscalyear=$r['fiscalyear'];
			$start_date_bs=$r['start_date_bs'];
			$start_date_ad=$r['start_date_ad'];

			//reading sourcecode
			$rsSourceCode=mysqli_query($conn,"select * from sourcecode where categoryId=1");
			$r=mysqli_fetch_assoc($rsSourceCode);
			$sourceCodeId=$r['id'];
			$codeLength=$r['codeLength'];
			$entryNo=substr("00000000001",-$codeLength);


			if (($natureId==1)||($natureId==3)){
				$debit=$openingBalance;
				$credit=0;
			}else if (($natureId==2)||($natureId==4)){
				$debit=0;
				$credit=$openingBalance;
			}
			$narration="अोपनिड०्ग व्यालेन्स";
			
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
			$qry=$qry.", approvalStatus, groupCode, subGroupCode, natureId)";
			
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
			$qry=$qry.",'".$groupId."'";
			$qry=$qry.",'".$subgroupId."'";
			$qry=$qry.",'".$natureId."')";
			$conn->query($qry);
		} //if opening balance is nor zero
	}
	
	//end of segment list and length list
	echo json_encode(array(
		"success" => $resp == 0,
		"message"=>$respMsg,
		"accountnos" => array(
			"id" => $id,
			"structureId" => $structureId,
			"accountNo"=>$accountNo,
			"accountDesc"=>$accountDesc,
			"account"=>$account,
			"address"=>$address,
			"contactNo"=>$contactNo,
			"email"=>$email,
			"openingBalance"=>$openingBalance,
			"status"=>$status,
			"subgroup"=>$subgroupDesc,
			"nature"=>$nature
		)
	));
?>