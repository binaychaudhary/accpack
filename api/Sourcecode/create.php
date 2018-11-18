<?php
	//chama o arquivo de conexão com o bd
	include("../../includes/conectar.php");

	$info = $_POST['sourcecodes'];

	$data = json_decode($info);
	
	$sourceCode = $data->sourceCode;
	$categoryId = $data->categoryId;
	$shortCode=$data->shortCode;
	$codeLength=$data->codeLength;
	$status=$data->status;
	

	

	//consulta sql
	$query = sprintf("INSERT INTO sourcecode (sourceCode,categoryId,shortCode, codeLength,status) values ('%s','%d','%s','%d','%d')",
		$conn->real_escape_string($sourceCode),
		$conn->real_escape_string($categoryId),
		$conn->real_escape_string($shortCode),
		$conn->real_escape_string($codeLength),
		$conn->real_escape_string($status)
	);

	$rs = $conn->query($query);

	$rs=$conn->query("select * from sourcecodecategory where id='".$categoryId."'");
	$r=mysqli_fetch_assoc($rs);
	$category=$r['category'];
	
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sourcecodes" => array(
			"id" => mysqli_insert_id($conn),
			"sourceCode" => $sourceCode,
			"categoryId" => $categoryId,
			"shortCode"=>$shortCode,
			"codeLength"=>$codeLength,
			"status"=>$status,
			"category"=>$category
		)
	));
?>