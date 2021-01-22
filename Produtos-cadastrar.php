<?php
	include 'Config.php';

	include 'produtos.class.php';
	
	$produtos = new Produtos($pdo);
	
	if(isset($_GET['pagina']) && $_GET['pagina'] <= 0 ){
		header('Location: produtos-cadastrar.php?pagina=1');
	}
	if(!isset($_GET['pagina']) && !isset($_GET['exportar'])){
		header('Location: produtos-cadastrar.php?pagina=1');
	}
	
	if(isset($_GET['pagina']) && $_GET['pagina'] > intval($produtos->totalPaginas(10))){
		header('Location: produtos-cadastrar.php?pagina=1');
	}
	
	if(isset($_GET['exportar'])){
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/vnd.ms-excel");
		header ("Content-Disposition: attachment; filename=\"nome_arquivo.xls\"" );
		header ("Content-Description: PHP Generated Data" );
	}
	
?>


<span class="btn-export"><a href="produtos-cadastrar.php?exportar"><i class="fa fa-file-excel-o" style="font-size:24px">Exportar</i></a></span>


<html lang="pt-br">
<head>
<meta charset="UTF-8"/>
<title> Lista de Produtos </title>

<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<header>
	<b style="margin-left: 40%;color:red;">Lista de produtos <i class="fa fa-buysellads" style="font-size:36px"></i></b>
</header>
<body>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="produtos-lista.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php if(!empty($produtos->listarItensCadastrar(20,$_GET['pagina']))): ?><i class="fa fa-eye" style="font-size:24px; color: red;"></i><?php endif;?><?php if(empty($produtos->listarItensCadastrar(20,$_GET['pagina']))): ?><i class="fa fa-eye-slash" style="font-size:24px; color: green;"></i><?php endif;?>Produtos cadastrar</li>
  </ol>
</nav>

<div class="div-table">
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<table class="table table-striped table-hover">
<thead>
<tr>
	<th>ID</th>
	<th>ITEM</th>
	<th>NUM</th>
	<th>DESCRIÇÃO</th>
	<th>COD BARRAS</th>
	<th>COD TOTVS</th>
	<th>NCM</th>
	<th>PREÇO VENDA</th>
	<th>REFERÊNCIA</th>
	<th>DATA REGISTRO</th>
	<th>AÇÕES</th>
</tr>
</thead>


<tbody id="myTable">
<?php 
	if(isset($_GET['pagina'])){
	$produto = $produtos->listarItensCadastrar(20,$_GET['pagina']);
	}else{
		$produto = $produtos->listarItensCadastrar(20,1);
	}
	foreach($produto as $item): 
?>

<tr>
<td><?php echo $item['id'] ?></td>
<td><?php echo $item['item'] ?></td>
<td><?php echo $item['num'] ?></td>
<td><?php echo $item['descricao'] ?></td>
<td><?php echo $item['codBarras'] ?></td>
<td><?php echo $item['codTotvs'] ?></td>
<td><?php echo $item['ncm'] ?></td>
<td><?php echo $item['pcVenda'] ?></td>
<td><?php echo $item['referencia'] ?></td>
<td><?php echo $item['dataRegistro2'] ?></td>
<td><?php if(empty($item['dataRegistro'])): ?><a href="Cadastrar.php?cadastrado=<?php echo $item['id']?>&pagina=<?php echo $_GET['pagina']?>"><button class="btn btn-danger">Cadastrar</button><?php endif; ?><?php if(!empty($item['dataRegistro'])): ?><button class="btn btn-primary">Cadastrado<i class="fa fa-check" style="font-size:20px;color:red;"></i></button><?php endif; ?></a></td>
</tr>

<?php endForeach; ?>
</tbody>


</table>

<div>
	<a href="?pagina=<?php echo $produtos->botoesPaginacao($_GET['pagina'],'+',20) ?>" class="avançar"><i class="fa fa-share" style="font-size:36px"></i></a>
	<a href="?pagina=<?php echo $produtos->botoesPaginacao($_GET['pagina'],'-',20) ?>" class="voltar"><i class="fa fa-reply" style="font-size:36px"></i></a>
<div>
</div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>

<footer>
	<b>Made by André Vitor</b>
</footer>
</html>