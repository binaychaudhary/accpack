<?php
	//chama o arquivo de conexão com o bd
	include_once("../../includes/conectar.php");
	$info = $_POST['sourcecodes'];

	$data = json_decode($info);
	$id=$data->id;
	$sourceCode=$data->sourceCode;
	$status = $data->status;
	$categoryId=$data->categoryId;
	$shortCode=$data->shortCode;
	$codeLength=$data->codeLength;
	
	

	//consulta sql
	$query = sprintf("UPDATE sourcecode SET sourceCode = '%s', status = '%d', categoryId='%d', shortCode='%s', codeLength='%d' WHERE id=%d",
		$conn->real_escape_string($sourceCode),
		$conn->real_escape_string($status),
		$conn->real_escape_string($categoryId),
		$conn->real_escape_string($shortCode),
		$conn->real_escape_string($codeLength),
		$conn->real_escape_string($id)
	);

	$rs = $conn->query($query);

	$rs=$conn->query("select * from sourcecodecategory where id='".$categoryId."'");
	$r=mysqli_fetch_assoc($rs);
	$category=$r['category'];

	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"sourcecodes" => array(
			"id" => $id,
			"sourceCode" => $sourceCode,
			"categoryId" => $categoryId,
			"shortCode"=>$shortCode,
			"codeLength"=>$codeLength,
			"status"=>$status,
			"category"=>$category
		)
	));
?>