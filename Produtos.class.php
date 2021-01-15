<?php


	class Produtos{
		private $pdo;
		
		public function __construct($pdo){
			$this->pdo = $pdo;
		}
		
		
		public function cadastrar($item, $num, $desc, $codBarras, $codTotvs, $ncm, $pcVenda, $ref){
			$sql = "INSERT INTO produtos() values(null, :item, :num, :desc, :codBarras, :codTotvs, :ncm, :pcVenda, :ref, null,null);";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':item', $item);
			$sql->bindValue(':num', $num);
			$sql->bindValue(':desc', $desc);
			$sql->bindValue(':codBarras', $codBarras);
			$sql->bindValue(':codTotvs', $codTotvs);
			$sql->bindValue(':ncm', $ncm);
			$sql->bindValue(':pcVenda', $pcVenda);
			$sql->bindValue(':ref', $ref);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
			
		}
		
		public function listarItens($total_reg, $pagina){
			
			$inicio = $this->valorInicial($total_reg, $pagina);
			
			$sql = "SELECT * FROM produtos ORDER BY dataEmissao desc";
			$limite = "SELECT *, DATE_FORMAT(dataRegistro,'%d-%m-%Y') AS `dataRegistro2` FROM produtos limit $inicio, $total_reg";

			$sql = $this->pdo->query($sql);
			$limite = $this->pdo->query($limite);	
		
			$tr = $sql->rowCount();
			$tp = $tr / $total_reg;
	
			
			if($sql->rowCount() > 0){
				return $limite->fetchAll();
			}else{
				return array();
			}
		}
		
		
		public function cadastroRealizado($id){
			$sql = "UPDATE produtos SET dataRegistro = date(NOW()) WHERE id IN(:id);";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':id', $id);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		
		
		/* Códigos reaproveitados */
		
		public function valorInicial($total_reg, $pagina){	
			if(!$pagina){
			$pc = 1;
		} else{
			$pc = $pagina;
		}
		
		$inicio = $pc - 1;
		$inicio = $inicio * $total_reg;
		
		return $inicio;
	}
	public function totalPaginas($total_reg){
		$sql = "SELECT * FROM produtos";
		$sql = $this->pdo->query($sql);
		return (intval($sql->rowCount()/$total_reg));
	}
	
	public function botoesPaginacao($pagina_atual, $tipo,$total_reg){
		if($tipo == '+'){
			$anterior = $pagina_atual + 1;
			return $anterior;
		}else {
			$proximo = $pagina_atual - 1;
			return $proximo;
		}
	}	
		
		
		
		
		
		
		
		
	}