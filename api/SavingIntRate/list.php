<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	$accountNo=$_REQUEST['accountNo'];
    $accountDesc=$_REQUEST['accountDesc'];
    $address=$_REQUEST['address'];
    $effectiveFrom = $_REQUEST['effectiveFrom'];
    $effectiveUpto = $_REQUEST['effectiveUpto'];
    $cr="";
    if(is_null($accountNo)||($accountNo=="")){
    }else{
        $cr=" where am.accountNo like '%".$accountNo . "%'";
    }
    if(is_null($accountDesc)||($accountDesc=="")){
    }else{
        if($cr==""){
            $cr=" where a.accountDesc like '%".$accountDesc . "%'";
        }else{
            $cr = $cr." and a.accountDesc like '%".$accountDesc . "%'";
        }
    }
    if(is_null($address)||($address=="")){
    }else{
        if($cr==""){
            $cr=" where a.address like '%".$address . "%'";
        }else{
            $cr = $cr." a a.address like '%".$address . "%'";
        }
    }
    if(is_null($effectiveFrom)||($effectiveFrom=="")){
    }else{
        if($cr==""){
            $cr=" where am.effectiveDateAd >= '".$effectiveFrom . "'";
        }else{
            $cr = $cr." and am.effectiveDateAd >= '".$effectiveFrom . "'";
        }
    }
    if(is_null($effectiveUpto)||($effectiveUpto=="")){
    }else{
        if($cr==""){
            $cr=" where am.effectiveDateAd <= '".$effectiveUpto . "'";
        }else{
            $cr = $cr." and am.effectiveDateAd <= '".$effectiveUpto . "'";
        }
    }
        

	$queryString = "SELECT am.*, a.accountDesc, a.address from saving_int_rate am left join acmaster a on am.accountNo= a.accountNo".$cr;

	//consulta sql
	$rs = $conn->query($queryString) or die(mysqli_connect_error());
    $cnt=0;
	$data = array();
	while($dat = mysqli_fetch_assoc($rs)) {
		$cnt=$cnt+1;
	    $data[] = $dat;
	}
	
	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $cnt,
		"savingintrates" => $data
	));
?>