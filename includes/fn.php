<?php
	function uploadImage($id, $category, $filename)
	{		
	    $allowedExts = array("gif", "jpeg", "jpg", "png",  "mp4",  "mp3",  "wma",  "mov",  "pdf");
		$temp = explode(".", $filename["name"]);
		$extension = end($temp);
		$error=null;
		$resp=true;
		$fileName=null;		
			
		if ((($filename["type"] == "image/gif")
		|| ($filename["type"] == "image/jpeg")
		|| ($filename["type"] == "image/jpg")
		|| ($filename["type"] == "image/pjpeg")
		|| ($filename["type"] == "image/x-png")
		|| ($filename["type"] == "audio/mp3")
		|| ($filename["type"] == "video/mov")		
		|| ($filename["type"] == "video/mp4")
		|| ($filename["type"] == "video/wma")
		|| ($filename["type"] == "application/pdf")		
		|| ($filename["type"] == "image/png"))
		&& ($filename["size"] < 1048576000)
		&& in_array($extension, $allowedExts))
		{
			if ($filename["error"] > 0)
			{ 
			
				$error="Return Code: " . $filename["error"];
				$resp=$filename["error"];
				
			}
			else
			{
			// echo "Upload: " . $filename["name"];
			// echo "Type: " . $filename["type"];
			// echo "Size: " . ($filename["size"] / 1024) . " kB";
			// echo "Temp file: " . $filename["tmp_name"];
				
				$fileN =$category."_".$id.".".$extension;
				echo $fileN;
				exit;
				if (file_exists("../images/".$fileN))
				{
					unlink($fileN);
				}
				//rreating the image file

				move_uploaded_file($filename["tmp_name"],"../images/".$fileN);
					
				$error="";
				$resp=true;
			
			}
		}
		else
		{
			$error= "Invalid file";
			$resp=false;
		}
		return $resp;
	}
?>