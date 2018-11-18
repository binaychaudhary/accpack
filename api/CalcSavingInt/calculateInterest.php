<?php
	include("../../includes/conectar.php");
	$accountNo = $_REQUEST['accountNo'];
	$date_ad = date($_REQUEST['date_ad']);
	$rate = $_REQUEST['rate'];

	//finding last calculated date
	$sql ="select * from int_calc_record where accountNo ='".$accountNo."' and calcDateAd<'".$date_ad."' order by calcDateAd desc";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)){
		$r=mysqli_fetch_assoc($rs);
		$last_calc_date_ad = date($r['calcDateAd']);
	}else{
		//getting the first entry date
		$sql = "select * from tmpentry where accountNo='".$accountNo."' and entry_date_ad<'".$date_ad."' order by entry_date_ad desc";
		$rs = $conn->query($sql);
		if(mysqli_num_rows($rs)){
			$r=mysqli_fetch_assoc($rs);
			$last_calc_date_ad=date($r['entry_date_ad']);
		}else{
			$last_calc_date_ad = date($date_ad);
		}
	}
	//echo "last calc date ".$last_calc_date_ad;

	//getting the last balance
	$sql ="select sum(debit) as debitSum, sum(credit) as creditSum from tmpentry where accountNo='".$accountNo."' and entry_date_ad<='".$last_calc_date_ad."'";
	$rs = $conn->query($sql);
	if(mysqli_num_rows($rs)>0){
		$r=mysqli_fetch_assoc($rs);
		$balance = $r['creditSum']-$r['debitSum'];
	}

	//echo "<br> Last Balance : ".$balance;
	
	$int=0;
	$total_int=0;
	//getting the transaction Records
	$sql ="select * from tmpentry where accountNo='".$accountNo."' and entry_date_ad>'".$last_calc_date_ad."' and entry_date_ad<='".$date_ad."'";
	$rs = $conn->query($sql);

	//echo "<br>no of records ".mysql_num_rows($rs);
	
	if(mysqli_num_rows($rs)>0){
		while($r=mysqli_fetch_assoc($rs)){
			$days = floor((strtotime($r['entry_date_ad'])-strtotime($last_calc_date_ad))/(60*60*24));
			$int = (($balance * ($rate/100))/365)*$days;
			$total_int = $total_int + $int;
			$balance = $balance + $r['credit']-$r['debit'];
			$last_calc_date_ad = date($r['entry_date_ad']);
		}
	}
	//echo "<br> from Date ".$last_calc_date_ad;
	//echo "<br> upto Date ".$date_ad;
	$totalTime = strtotime($date_ad)-strtotime($last_calc_date_ad);
	$days = floor($totalTime/(60*60*24));
	//echo "<br> No of Days ".$days."<br>";
	
	$int = (($balance * ($rate/100))/365)*$days;
	$total_int = $total_int + $int;
	//returning the interest value
	echo json_encode(array(
		"balance"=>$balance,
		"interest" => $total_int
	));

?>