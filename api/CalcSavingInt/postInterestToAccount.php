<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	$fiscalyear=$_REQUEST['fiscalyear'];
	$accountNo=$_REQUEST['accountNo'];
	$account=$_REQUEST['account'];
	$debit=$_REQUEST['debit'];
	$credit=$_REQUEST['credit'];
	$start_date_bs=$_REQUEST['entry_date_bs'];
	$start_date_ad=$_REQUEST['entry_date_ad'];
	$sourceCodeId=$_REQUEST['sourceCodeId'];
	$entryNo = $_REQUEST['entryNo'];

	$respMsg="";

	$supliedSegment=array();
	$supliedSegment=split("-",$accountNo);
	$subgroup=$supliedSegment[0];
	
	$rssubgroup=$conn->query("SELECT * from subgroup where subGroupCode='".$subgroup."'");
	$r=mysqli_fetch_assoc($rssubgroup);
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
	
	//if($credit<>0){

		$narration="Interest Payment on ".$start_date_bs;
		//inserting in entry

		$qry="insert into tmpentry(fiscalyear";
		$qry=$qry.", sourceCodeId";
		$qry=$qry.", accountNo";		
		$qry=$qry.", account";
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
		$qry=$qry.",'". $accountNo."'";
		$qry=$qry.",'". $entryNo."'";
		$qry=$qry.",'". $start_date_bs."'";
		$qry=$qry.",'". date('Y-m-d',strtotime($start_date_ad))."'";
		$qry=$qry.",". $debit."";
		$qry=$qry.",". $credit."";
		$qry=$qry.",'1'";
		$qry=$qry.",'". $narration."'";
		$qry=$qry.",'1'";
		$qry=$qry.",'".$groupCode."'";
		$qry=$qry.",'".$subGroupCode."'";
		$qry=$qry.",'".$natureId."')";
		$conn->query($qry);

		
	//} //if credit(interest) is nor zero
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0
	));
?>