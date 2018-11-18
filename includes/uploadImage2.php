<?php

$id = $_POST['id'];
$category=$_POST['category2'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["image-upload2"]["name"]);
$extension = end($temp);
$error=null;
$resp=true;
$fileName=null;
if ((($_FILES["image-upload2"]["type"] == "image/gif")
|| ($_FILES["image-upload2"]["type"] == "image/jpeg")
|| ($_FILES["image-upload2"]["type"] == "image/jpg")
|| ($_FILES["image-upload2"]["type"] == "image/pjpeg")
|| ($_FILES["image-upload2"]["type"] == "image/x-png")
|| ($_FILES["image-upload2"]["type"] == "image/png"))
&& ($_FILES["image-upload2"]["size"] < 5000000)
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
			$error= "Image already exists. ";
			$resp=false;
		}
		else
		{
			move_uploaded_file($_FILES["image-upload2"]["tmp_name"],"../".$fileName);
			
			include("conectar.php");
			if($category=="saving"){
				$update_image_url="update savingacdetail set photo_url ='".$fileName."' where id='".$id."'";	
			}else if($category=="signature1"){
				$update_image_url="update savingacdetail set signature1_url ='".$fileName."' where id='".$id."'";
			}else if($category=="signature2"){
				$update_image_url="update savingacdetail set signature2_url ='".$fileName."' where id='".$id."'";
			}		
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
	"success" => $resp,
	"error" => $error,
	"filename" => $fileName		
));
?>