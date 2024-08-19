<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "banco_jundtask";
	
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	if ($conn->connect_error) {
		echo "erro";
	}
?>