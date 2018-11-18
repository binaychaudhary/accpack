<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['vouchers'];

	$fiscalyear = $data->fiscalyear;
	$sourceCodeId=$data->sourceCodeId;
	$entryNo=$data->entryNo;
	$entry_date_bs=$data->entry_date_bs;
	$entry_date_ad=$data->entry_date_ad;
	$id=$data->id;
	$accountNo=$data->accountNo;
	$account=$data->account;
	if($data->debit>0){
		$debit=$data->debit;
		$credit=null;	
	}else if($data->credit>0){
		$debit=null;
		$credit=$data->credit;
	}
	$collectorId=$data->collectorId;
	$narration=$data->narration;
	$userId=$data->userId;
	
	// $fiscalyear = $_REQUEST['fiscalyear'];
	// $sourceCodeId=$_REQUEST['sourceCodeId'];
	// $entryNo=$_REQUEST['entryNo'];
	// $entry_date_bs=$_REQUEST['entry_date_bs'];
	// $entry_date_ad=$_REQUEST['entry_date_ad'];
	// $id=$_REQUEST['id'];
	// $accountNo=$_REQUEST['accountNo'];
	// if($_REQUEST['debit']>0){
	// 	$debit=$_REQUEST['debit'];
	// 	$credit=null;
	// }else if($_REQUEST['credit']>0){
	// 	$credit=$_REQUEST['debit'];
	// 	$debit	=null;
	// }
	// $collectorId=$_REQUEST['collectorId'];
	// $narration=$_REQUEST['narration'];
	// $userId=$_REQUEST['userId'];
	
	$entry_date_ad= $entry_date_ad .' '.date('H:i:s');
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
	//finding groupCode
	$rs=$conn->query("select * from groups where id='".$groupId."'");
	$r=mysqli_fetch_assoc($rs);
	$groupCode = $r['groupCode'];
	

	//finding subgroupcode
	$rs=$conn->query("select * from subgroup where id='".$groupId."' order by subGroupCode");
	$r=mysqli_fetch_assoc($rs);
	$subgroupId=$r['id'];
	$subGroupCode = $r['subGroupCode'];
	
	//consulta sql
	$query = "UPDATE tmpentry SET entry_date_bs = '".$entry_date_bs."', accountNo='".$account."', accountNo='".$account."', groupCode='".$groupId."', subGroupCode='".$subgroupId."', natureId='".$natureId."', debit=$debit, credit=$credit, collectorId='".$collectorId."', userId='".$userId."', ac_group='$ac_group', g1='$g1', g2='$g2', g3='$g3', g4='$g4', g5='$g5' WHERE id='".$id."'";
	
	$rs = $conn->query($query);

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"vouchers" => array(
			"id" => $id,
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
			"userId"=>$userId
		)
	));
?>