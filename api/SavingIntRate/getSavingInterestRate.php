<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$accountNo=$_REQUEST['accountNo'];
    $effectiveFrom = $_REQUEST['effectiveFrom'];
    $cr="";
    if(is_null($accountNo)||($accountNo=="")){
    }else{
        $cr=" where am.accountNo like '%".$accountNo . "%'";
    }
    
    if(is_null($effectiveFrom)||($effectiveFrom=="")){
    }else{
        if($cr==""){
            $cr=" where am.effectiveDateAd <= '".$effectiveFrom . "'";
        }else{
            $cr = $cr." and am.effectiveDateAd <= '".$effectiveFrom . "'";
        }
    }

	$queryString = "SELECT * from saving_int_rate am ".$cr." order by am.effectiveDateAd desc limit 1";

	//consulta sql
	$rs =$conn->query($queryString) or die(mysqli_connect_error());
    $cnt=0;
    if(mysqli_num_rows($rs)){
        $r = mysqli_fetch_assoc($rs);
        $rate = $r['rate'];
    }else{
        $rate = 0;
    }
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"rate" => $rate
	));
?>