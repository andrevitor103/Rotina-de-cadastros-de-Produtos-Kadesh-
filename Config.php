<?php 

	try{

		$pdo = new PDO("mysql:dbname=controleprodutos; host=srv-015","root","4362106");

	}catch(PDOException $e){

		echo "ERRO: ".$e->getMessage();	
		exit;
		
	}


?>