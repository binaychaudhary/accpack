<?php 
	include("../../includes/conectar.php");
	
	
	//if(is_uploaded_file($_FILES['import_file']['tmp_name'])) {
		$segment_id = $_POST['segment_id'];
		//$segment_id = 200;
		//$readfile($_FILES['import_file']['tmp_name']);
		$handle=fopen($_FILES['import_file']['tmp_name'],"r");
		$r=0;
		while (($data =fgetcsv($handle,1000,","))!==FALSE) {
			# code...
			if($r>0){
				$importSql ="insert into segmentdata(segment_id,segment_code,name_np) values('".$segment_id."','".$data[0]."','".$data[1]."')";
				//echo $importSql;

				$conn->query($importSql);
			}
			$r=$r+1;
		}
	//}
	//data impoted

	//selecting data for list
	$cr=" where segment_id='".$segment_id."'";
	//echo "<br>".$cr;
	$queryString = "SELECT * FROM segmentData ".$cr;
	//echo "<br>".$queryString."<br>";
	//consulta sql
	$query = $conn->query($queryString) or die(mysqli_connect_error());

	//faz um looping e cria um array com os campos da consulta
	$segments = array();
	while($segment = mysqli_fetch_assoc($query)) {
	    $segments[] = $segment;
	}

	//consulta total de linhas na tabela
	$queryTotal = $conn->query('SELECT count(*) as num FROM segmentData'.$cr) or die(mysqli_connect_error());
	$row = mysqli_fetch_assoc($queryTotal);
	$total = $row['num'];

	//encoda para formato JSON
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"total" => $total,
		"segmentdatas" => $segments
	));
?>