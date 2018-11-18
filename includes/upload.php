<html>
<div id="container">
<div id ="form">
<?php 
	
	if(isset($_POST['submit'])){
		include("conectar.php");
	
	
		if(is_uploaded_file($_FILES['import_file']['tmp_name'])) {
			$segment_id = $_POST['segment_id'];
			//$readfile($_FILES['import_file']['tmp_name']);
			$handle=fopen($_FILES['import_file']['tmp_name'],"r");
			$r=0;
			while (($data =fgetcsv($handle,1000,","))!==FALSE) {
				# code...
				$importSql ="insert into segmentdata(segment_id,segment_code,name_np) values('".$segment_id."','".$data[0]."','".$data[1]."')";
				if($r>0){
					$conn->query($importSql);	
				}
				$r=$r+1;
			}
		}
		fclose($handle);
		//data impoted
		echo "Import successfully done";	
	}else{
		print "upload new csv by browsing to file and clicking on Upload<br />\n";
		print "<form enctype='multipart/form-data' action = '../api/segdata/importSegmentData.php' method='post'>";
		print "Segment ID <input type = 'text' name='segment_id' id='segment_id'><br>";
		print "Fine name to Import :<br>\n";
		print "<input size='50' type='file' name='import_file'><br>\n";
		print "<input type='submit' name='submit' value='Import'></form>";
	}
?>
</div>
</div>
</html>