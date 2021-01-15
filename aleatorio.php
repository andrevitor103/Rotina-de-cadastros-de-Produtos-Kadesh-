<?php
	
	$numeros = [3,12,13,35,47,52];
	$loops = 0;
	$achou = 0;
	$numerosAcertados = 0;
	
	while($achou < 1){
		for($i = 0; $i < 6; $i++){
			$sorteado = rand(1,60);
			//echo $sorteado.'<br>';
			for($y = 0; $y < count($numeros); $y++){
				if($numeros[$y] == $sorteado){
					$numerosAcertados = $numerosAcertados + 1;
				}
				if($numerosAcertados == 6){
					//echo $numerosAcertados;
					$achou = 1;
					break;
				}
			}
		}
		$loops = $loops + 1;
		$numerosAcertados = 0;
		//echo $loops;
	}
	echo $loops.'<br>';

?>