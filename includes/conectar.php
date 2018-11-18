<?php
 
//nome do servidor (127.0.0.1)
$servidor = "192.168.1.3";
 
//usuário do banco de dados
$user = "root";
 
//senha do banco de dados
$senha = "01pass";
 
//nome da base de dados
$db = "pauwa";
	
//executa a conexão com o banco, caso contrário mostra o erro ocorrido
$conn = mysqli_connect($servidor,$user,$senha, $db ) or die (mysqli_connect_error());
 //unicode support

 $conn->query('SET character_set_results=utf8');
 $conn->query('SET names=utf8');
 $conn->query('SET character_set_client=utf8');
 $conn->query('SET character_set_connection=utf8');
 $conn->query('SET character_set_results=utf8');
 $conn->query('SET collation_connection=utf8_general_ci');
?>