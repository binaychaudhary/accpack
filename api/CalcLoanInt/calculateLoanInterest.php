<?php
	include("../../includes/conectar.php");
	$accountNo=$_REQUEST['accountNo'];
	$calculationDateAd=$_REQUEST['date_ad'];
	$rate = $_REQUEST['rate'];
	//echo "<br>calculation date : ".Date($_REQUEST['calculationDateAd']);
	//computing Balance
	$sql="select sum(debit) as debit, sum(credit) as credit from tmpentry where accountNo ='".$accountNo."' and entry_date_ad<'".Date($calculationDateAd)."'";
	//echo "<br>sql :".$sql;
	$rs= $conn->query($sql);
	$debit  = 0;
	$credit = 0;
	$balance = 0;
	if(mysqli_num_rows($rs)>0){
		$r = mysqli_fetch_assoc($rs);
		$debit = $r['debit'];
		$credit=$r['credit'];
		$balance = $debit-$credit;
		//echo "<br>Balance : ".$balance;
	}
	
	//finding last calculation date
	$sql ="select * from loan_int_calc_record where accountNo ='".$accountNo."' and calcDateAd<'".$calculationDateAd."' order by calcDateAd desc";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)){
		$r=mysqli_fetch_assoc($rs);
		//$last_calc_date_ad = date($r['calcDateAd']);
		$last_calc_date_ad = date("01/14/2017"]);
	}else{
		//getting the first entry date
		$sql = "select * from tmpentry where accountNo='".$accountNo."' and entry_date_ad<'".$calculationDateAd."' order by entry_date_ad desc";
		$rs = $conn->query($sql);
		if(mysqli_num_rows($rs)){
			$r=mysqli_fetch_assoc($rs);
			$last_calc_date_ad=date('01/14/2017']);
		}else{
			$last_calc_date_ad = date('01/14/2017');
		}
	}

	// $sql ="select max(entry_date_ad) as last_entry_date from tmpentry where accountNo='".$accountNo."' and debit>0";
	// //echo "<br>sql :".$sql;
	// $rs = mysql_query($sql);
	// $r=mysql_fetch_assoc($rs);
	// $last_entry_date=Date(substr($r['last_entry_date'],0,10));
	// //echo  "<br> last entry date ad :".substr($last_entry_date,0,10);
	$numberOfDays = floor((strtotime(Date($calculationDateAd)) - strtotime($last_calc_date_ad))/(60*60*24));

	
	$groupCode = substr($accountNo,0,5);
	//echo "<br>Group :".$groupCode;

	// $sql="select id from subgroup where subGroupCode='".$groupCode."'";
	// $rs = mysql_query($sql);
	// $r=mysql_fetch_assoc($rs);
	// $SubGroupId =$r['id'];
	// $rate=0;
	// $sql="select * from loanintrate where subGroupId='".$SubGroupId."'";
	// $rs = mysql_query($sql);
	// if(mysql_num_rows($rs)>0){
	// 	$r = mysql_fetch_assoc($rs);
	// 	$intRate = $r['rate'];
	// }else{
	// 	$intRate=0;
	// }

	$interest = (($balance * ($rate/100))/365)*$numberOfDays;
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"loan" => $balance ,
		"interest" => $interest,
		"rate" => $rate,
		"nofdays" =>$numberOfDays
	));
?>