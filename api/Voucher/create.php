<?php
	include("../../includes/conectar.php");

	$fiscalyear = $_REQUEST['fiscalyear'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo=$_REQUEST['entryNo'];
	$accountNo=$_REQUEST['accountNo'];
	$account= $_REQUEST['account'];
	$debit=$_REQUEST['debit'];
	$credit=$_REQUEST['credit'];
	$entry_date_ad=$_REQUEST['entry_date_ad'];
	$entry_date_bs=$_REQUEST['entry_date_bs'];
	$collectorId=$_REQUEST['collectorId'];
	$narration=$_REQUEST['narration'];
	$userId=$_REQUEST['userId'];
	$chequeNo=$_REQUEST['chequeNo'];

	if(is_null($chequeNo)){
		$chequeNo =0;
	}
	if(is_null($collectorId)){
		$collectorId =0;
	}
	if((is_null($credit)) || ($credit=='')){
		$credit =0;
	}

	if((is_null($debit)) || ($debit=='')){
		$debit =0;
	}
	

	//date_default_timezone_set('Asia/Kathmandu');
	//$entry_date_ad=substr($entry_date_ad,0,10);
	
	$rs=$conn->query("select * from acmaster where accountNo='".$accountNo."'");
	$r=mysqli_fetch_assoc($rs);
	//$rs = mysql_query($query);
	$accountDesc=$r['accountDesc'];
	$groupId =$r['groupId'];
	$subgroupId=$r['subgroupId'];
	$ac_group = $r['ac_group'];
	$g1=$r['g1'];
	$g2=$r['g2'];
	$g3=$r['g3'];
	$g4=$r['g4'];
	$g5=$r['g5'];
	$natureId=$r['natureId'];

	if(is_null($g1)){
		$g1 =0;
	}
	if(is_null($g2)){
		$g2 =0;
	}
	if(is_null($g3)){
		$g3 =0;
	}
	if(is_null($g4)){
		$g4 =0;
	}
	if(is_null($g5)){
		$g5 =0;
	}
	//finding groupCode
	$rs=$conn->query("select * from groups where id='".$groupId."'");
	$r=mysqli_fetch_assoc($rs);
	$groupId = $r['id'];
	$groupCode = $r['groupCode'];
	

	//finding subgroupcode
	$rs=$conn->query("select * from subgroup where id='".$subgroupId."' order by subGroupCode");
	$r=mysqli_fetch_assoc($rs);
	$subGroupCode = $r['subGroupCode'];
	$subGroupId=$r['id'];
	
	//$entry_date_ad=substr($entry_date_ad,0,10).' '.date("H:i:s");

	$query = sprintf("INSERT INTO tmpentry (fiscalyear, sourceCodeId, entryNo, entry_date_bs, entry_date_ad, accountNo, account, debit, credit, collectorId, narration, userId, chequeNo, groupCode, subGroupCode, natureId,ac_group, g1,g2,g3,g4,g5) values ('%s','%d','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s','%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d')",
		$conn->real_escape_string($fiscalyear),
		$conn->real_escape_string($sourceCodeId),
		$conn->real_escape_string($entryNo),
		$conn->real_escape_string($entry_date_bs),
		$conn->real_escape_string($entry_date_ad),
		$conn->real_escape_string($accountNo),
		$conn->real_escape_string($account),
		$debit,
		$credit,
		$conn->real_escape_string($collectorId),			
		$conn->real_escape_string($narration),
		$conn->real_escape_string($userId),
		$conn->real_escape_string($chequeNo),
		$conn->real_escape_string($groupId),
		$conn->real_escape_string($subGroupId),
		$conn->real_escape_string($natureId),
		$ac_group,
		$g1,
		$g2,
		$g3,
		$g4,
		$g5
	);

	$conn->query($query);
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		//"qry"=>$query,
		"fiscalyear" => $fiscalyear,
			"sourceCodeId" => $sourceCodeId,
			"entryNo"=>$entryNo,
			"entry_date_bs"=>$entry_date_bs,
			"entry_date_ad"=>$entry_date_ad,
			"accountNo"=>$accountNo,
			"account"=>$account,
			"debit"=>number_format($debit,2),
			"credit"=>number_format($credit,2),
			"collectorId"=>$collectorId,
			"narration"=>$narration,
			"accountDesc"=>$accountDesc,
			"userId"=>$userId,
			"query"=>$query
	));
?>