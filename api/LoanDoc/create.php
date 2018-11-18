<?php
	//chama o arquivo de conex�o com o bd
	include("../../includes/conectar.php");

	 $info = $_POST['loandoc'];

	 $data = json_decode($info);

	$loan_ac_id = $data->loan_ac_id;
	$doc_type = $data->doc_type;
	$url=$data->url;
	
	
	$rs=$conn->query("select * from kagjatname where id='".$doc_type."'");
	$r=mysqli_fetch_assoc($rs);
	$kagjatname=$r['kagjatname'];
	
	//consulta sql
	$query = sprintf("INSERT INTO loan_doc(loan_ac_id, doc_type ) values ('%d','%d')",
		$conn->real_escape_string($loan_ac_id),
		$conn->real_escape_string($doc_type)
	);

	$rs = $conn->query($query);
	$id = mysqli_insert_id($conn);

	$category="docs";
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["image-upload"]["name"]);
	$extension = end($temp);
	$error=null;
	$resp=true;
	$fileName=null;
	if ((($_FILES["image-upload"]["type"] == "image/gif")
	|| ($_FILES["image-upload"]["type"] == "image/jpeg")
	|| ($_FILES["image-upload"]["type"] == "image/jpg")
	|| ($_FILES["image-upload"]["type"] == "image/pjpeg")
	|| ($_FILES["image-upload"]["type"] == "image/x-png")
	|| ($_FILES["image-upload"]["type"] == "image/png"))
	&& ($_FILES["image-upload"]["size"] < 20000)
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["image-upload"]["error"] > 0)
		{
			$error="Return Code: " . $_FILES["image-upload"]["error"];
			$resp=false;
		}
		else
		{
		// echo "Upload: " . $_FILES["image-upload"]["name"];
		// echo "Type: " . $_FILES["image-upload"]["type"];
		// echo "Size: " . ($_FILES["image-upload"]["size"] / 1024) . " kB";
		// echo "Temp file: " . $_FILES["image-upload"]["tmp_name"];

			$fileName ="upload/".$category."/".$id.".".$extension;
			if (file_exists("../".$fileName))
			{
				$error= "Image Already Exists. ";
				$resp=false;
			}
			else
			{
				move_uploaded_file($_FILES["image-upload"]["tmp_name"],"../".$fileName);
				
				$update_image_url="update loan_doc set url ='".$fileName."' where id='".$id."'";
				$url = $filename;
						
				$conn->query($update_image_url);
			}
		}
	}
	else
	{
		$error= "Invalid file";
		$resp=false;
	}
	
	echo json_encode(array(
		"success" => mysqli_connect_errno() == 0,
		"loandoc" => array(
			"id" => $id,
			"loan_ac_id" => $loan_ac_id,
			"doc_type" => $doc_type,
			"url"=>$url,
			"kagjatname"=>$kagjatname
		),
		"imageSuccess" => $resp,
		"error" => $error,
		"filename" => $fileName
	));
?>