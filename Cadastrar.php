<?php

include 'Config.php';

	include 'produtos.class.php';
	
	$produtos = new Produtos($pdo);
	
	if(isset($_GET['cadastrado'])){
		$produtos->cadastroRealizado($_GET['cadastrado']);
		header('Location: produtos-lista.php?pagina='.$_GET['pagina']);
	}
	