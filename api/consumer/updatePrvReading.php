<?php
	//chama o arquivo de conexão com o bd
	ini_set('max_execution_time', 600);
	include("../../includes/conectar.php");

	$sql="select * from consumer order by id";
	$rs =$conn->query($sql);
	while($r = mysqli_fetch_assoc($rs)){
		$id = $r['id'];

		$sqlBill = "select * from monthlybill where consumer_id = '$id' order by id";
		$rsBill = $conn->query(	$sqlBill);
		$sn=0;
		if(mysqli_num_rows(	$rsBill)>0){
			$prv_reading = 0;
			while($rBill = mysqli_fetch_assoc($rsBill)){
				$sn=$sn+1;
				$curReading = $rBill['cur_reading'];
				$rowId = $rBill['id'];				
				$unit = $rBill['cur_reading']-$prv_reading; 
				$updSql ="update monthlybill set prv_reading = '$prv_reading', unit ='$unit' where id='$rowId'";
				$conn->query(	$updSql);
				$prv_reading = $rBill['cur_reading'];				
			}
		}
	}
		echo "finished";
	?>