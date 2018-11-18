<?php
	date_default_timezone_set('Asia/Kathmandu');
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = ' ';
   $dbname = 'chaudhary';
   $dt = date('Y_m_d')."-".date('H-i-s').".sql";
   
   $backup_file = "e:/accpackbackup/".$dbname."_".$dt;
   //echo $backup_file;
    $command = "mysqldump -h $dbhost -u $dbuser -p $dbpass $dbname > ".$backup_file;
    //echo $command;
    system($command);
?>