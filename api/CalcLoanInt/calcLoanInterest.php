<?php
	include("../../includes/conectar.php");
	
	$sub_group_code=$_REQUEST['sub_group_code'];
	$calculation_date_ad=$_REQUEST['calculation_date_ad'];
	$calculation_date_bs=$_REQUEST['calculation_date_bs'];
	$created_by=$_REQUEST['created_by'];
	$fiscalYear=$_REQUEST['fiscalYear'];
	$entryNo = $_REQUEST['entryNo'];
	
	$sourceCodeId=1;
	$entry_date_ad=$calculation_date_ad;
	$entry_date_bs=$calculation_date_bs;
	$collectorId=null;				
	$chequeNo=null;
	$totalIntAmount=0;
	
	//GETTING SUB_GROUP_ID
	$sql ="select * from subgroup where subGroupCode='$sub_group_code'";
	$rs= $conn->query($sql);
	$r= mysqli_fetch_assoc($rs);
	$subGroupCode=$r['id'];
	//echo "<br>subGroupCode : ".$subGroupCode;
	//finding loan interest rate
	$sql ="select * from loanintrate where subGroupId='$subGroupCode' and effectedDateAd<='$calculation_date_ad'";
	//echo "<br>sql :".$sql;
	$rs= $conn->query($sql);
	$r= mysqli_fetch_assoc($rs);
	$intRate=$r['rate'];
	//echo substr($calculation_date_bs,0,7);
	
	//delete same month interest records
	$deleteIntRecord = "delete from loan_int_calc_record where calcDateBs like '".substr($calculation_date_bs,0,7)."%'";
	$conn->query($deleteIntRecord);

	$vnListQry="select distinct entryNo from tmpentry where narration like 'Loan Interest Calculated on ".substr($calculation_date_bs,0,7)."%'";
	$rs = $conn->query($vnListQry);
	$vn="";
	if(mysqli_num_rows($rs)>0){
		while($r= mysqli_fetch_assoc($rs)){
			if(is_null($vn)){
				$vn=$r['entryNo'];
			}else{
				$vn=$vn.','.$r['entryNo'];
			}
		}
	}

	$deleteInTmpEntry="delete from tmpentry where narration like 'Loan Interest Calculated on ".substr($calculation_date_bs,0,7)."%'";
	$conn->query($deleteInTmpEntry);

	$deleteInTmpEntry="delete from tmpentry where narration like 'Interest Received from Loan A/C%' and entry_date_bs like '".substr($calculation_date_bs,0,7)."%'";
	$conn->query($deleteInTmpEntry);



	$deleteInEntry="delete from entry where entryNo in(".$vn.") and fiscalyear = '".$fiscalYear."' and sourceCodeId='1'";
	$conn->query($deleteInEntry);

	
	//getting last entry No
	$rsSourceCode=$conn->query("select * from sourcecode where id='".$sourceCodeId."'");
	$r=mysqli_fetch_assoc($rsSourceCode);
	$codeLength=$r['codeLength'];
	if($sourceCodeId==6){
		$sql ="select max(entryNo) as maxEntryNo from stock where fiscalYear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."'";
	}else{
		$sql ="select max(entryNo) as maxEntryNo from entry where fiscalyear='".$fiscalYear."' and sourceCodeId='".$sourceCodeId."'";
	}

	$rs = $conn->query($sql);
	$r=mysqli_fetch_assoc($rs);
	$maxEntryNo = $r['maxEntryNo']+1;

	$entryNo=substr("0000000000".$maxEntryNo,-$codeLength);
	

	$sql="select * from acmaster where seg1='$sub_group_code' and status=1 order by id";

	$rs = $conn->query($sql);
	//echo "<br> Recor Found :".mysql_num_rows($rs);
	if(mysqli_num_rows($rs)>0){
		while($r= mysqli_fetch_assoc($rs)){
			$accountNo = $r['accountNo'];
			$accountDesc = $r['accountDesc'];
			$account= $accountNo." ".$accountDesc;
			//echo "<br> account : ".$account;
			$loan_ac_id = $r['id'];
			$groupId =$r['groupId'];
			$subgroupId=$r['subgroupId'];
			
			//calculating remaining loan
			$sql1="select sum(debit) as debit, sum(credit) as credit from tmpentry where accountNo ='".$accountNo."' and entry_date_ad<'".$calculation_date_ad."'";
			$rsBalance= $conn->query($sql1);
			$debit  = 0;
			$credit = 0;
			$balance = 0;
			if(mysqli_num_rows($rsBalance)>0){
				$rBalance = mysqli_fetch_assoc($rsBalance);
				$debit = $rBalance['debit'];
				$credit=$rBalance['credit'];
				$balance = $debit-$credit;
			}
			$interest_type_id=1;
			//echo "<br>Remaining Loan :".$balance;
			if($balance>0){				
				//finding interest calculation type i.e. flat or dimnishing
				$sql2="select * from loan_detail where loan_ac_id='$loan_ac_id' order by id desc limit 1";
				$rsLD= $conn->query($sql2);
				if(mysqli_num_rows($rsLD)>0){
					$rLD= mysqli_fetch_assoc($rsLD);
					$interest_type_id = $rLD['interest_type_id'];
					if($interest_type_id==1){
						$balance = round($rLD['approved_amount'],2);
					}					
					$intRate  = round($rLD['interest_per'],2);
				}

				//finding last calculation date
				$sql ="select * from loan_int_calc_record where accountNo ='".$accountNo."' and calcDateAd<='".$calculation_date_ad."' order by calcDateAd desc LIMIT 1";
				$rsCalc = $conn->query($sql);
				$last_calc_date_ad  =  date("Y-m-d");
				if(mysqli_num_rows($rsCalc)>0){
					$rCalc=mysqli_fetch_assoc($rsCalc);
					$last_calc_date_ad = date($rCalc['calcDateAd']);
				}else{
					//getting the first entry date
					//echo "date from tmpentry";
					$sql = "select * from tmpentry where accountNo='".$accountNo."' and entry_date_ad<'".$calculation_date_ad."'";
					$rsEntry = $conn->query($sql);
					if(mysqli_num_rows($rsEntry)>0){
						$rE=mysqli_fetch_assoc($rsEntry);
						$last_calc_date_ad=date($rE['entry_date_ad']);
					}
				}
				//FINDING NUMBER OF DAYS
				//echo "<br>Last Calculation Date :".$last_calc_date_ad." new Calc date :".$calculation_date_ad;
				$numberOfDays = floor((strtotime($calculation_date_ad) - strtotime($last_calc_date_ad))/(60*60*24));
				//echo "<br> nUM DAYS :".$numberOfDays;
				$intAmount = round(((($balance * ($intRate/100))/365)*$numberOfDays),2);
				//echo "<br>Balance :".$balance." int Rate :".$intRate." interest : ".$intAmount;
				$totalIntAmount = $totalIntAmount + $intAmount;
				//inserting into lo
				$query = "insert into loan_int_calc_record(accountNo";
				$query=$query.", calcDateBs";
				$query=$query.", calcDateAd";
				$query=$query.", created_by";
				$query=$query.", fiscalYear";
				$query=$query.", loan_amount";
				$query=$query.", intRate";
				$query=$query.", intAmount)";
				$query=$query."values(";
				$query=$query."'$accountNo'";
				$query=$query.",'$calculation_date_bs'";
				$query=$query.",'$calculation_date_ad'";	
				$query=$query.",'$created_by'";	
				$query=$query.",'$fiscalYear'";
				$query=$query.",'$balance'";
				$query=$query.",'$intRate'";
				$query=$query.",'$intAmount')";
				//echo "<br> insert into loan_int_calc_record: ".$query;
				$conn->query($query);
				

				$narration="Loan Interest Calculated on ".$calculation_date_bs;
				$debit=$intAmount;
				$credit=0;
				
				
				//finding groupCode
				$rsG=$conn->query("select * from groups where id='".$groupId."'");
				$rG=mysqli_fetch_assoc($rsG);
				$groupId = $rG['id'];
				$groupCode = $rG['groupCode'];
				$natureId=$rG['natureId'];

				//finding subgroupcode
				$rsSG=$conn->query("select * from subgroup where id='".$subgroupId."' order by subGroupCode");
				$rSG=mysqli_fetch_assoc($rsSG);
				$subGroupCode = $rSG['subGroupCode'];
				$subGroupId=$rSG['id'];
				//echo "<br> Group Id : ".$groupId." sub Group Id: ".$subGroupId;

				$query = sprintf("INSERT INTO tmpentry (fiscalyear, sourceCodeId, entryNo, entry_date_bs, entry_date_ad, accountNo, account, debit, credit, collectorId, narration, userId, chequeNo, groupCode, subGroupCode, natureId) values ('%s','%d','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s','%s', '%s', '%d')",
					$conn->real_escape_string($fiscalYear),
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
					$conn->real_escape_string($created_by),
					$conn->real_escape_string($chequeNo),
					$conn->real_escape_string($groupId),
					$conn->real_escape_string($subGroupId),
					$conn->real_escape_string($natureId)
				);
				//echo "<br>tmpentry insert sql :".$query;
				$conn->query($query);			
			}
		}

		
		if($totalIntAmount>0){
			$accountNo = '160.3-01';
			$accountDesc ='Interest Received from Loan A/C';
			$account = $accountNo.' '.$accountDesc;

			$sqlDTL="select * from acmaster where accountNo='$accountNo'";
			$rsDTL = $conn->query($sqlDTL);
			if(mysqli_num_rows($rsDTL)>0){
				$rDTL= mysqli_fetch_assoc($rsDTL);
				$accountNo= $rDTL['accountNo'];
				$account= $rDTL['accountNo']." ". $rDTL['accountDesc'];
				$groupId =$rDTL['groupId'];
				$subgroupId=$rDTL['subgroupId'];
				$natureId = $rDTL['natureId'];
			}


			$debit =0;
			$credit= $totalIntAmount;
			$narration='Interest Received from Loan A/C on '.$entry_date_bs ;

			//inserting interest income in tmpentry
			$query = sprintf("INSERT INTO tmpentry (fiscalyear, sourceCodeId, entryNo, entry_date_bs, entry_date_ad, accountNo, account, debit, credit, collectorId, narration, userId, chequeNo, groupCode, subGroupCode, natureId) values ('%s','%d','%s','%s','%s','%s','%s','%s','%s','%d','%s','%d','%s','%s', '%s', '%d')",
				$conn->real_escape_string($fiscalYear),
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
				$conn->real_escape_string($created_by),
				$conn->real_escape_string($chequeNo),
				$conn->real_escape_string($groupId),
				$conn->real_escape_string($subgroupId),
				$conn->real_escape_string($natureId)
			);
			$conn->query($query);
			//inserting in calculation record
			$qr ="insert into calculation_record(sub_group_code,calc_date_bs,calc_date_ad) values('$sub_group_code','$entry_date_bs','$entry_date_ad')";
			$conn->query($qr);	
		}		
	}

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"interest" => $totalIntAmount
	));

?>