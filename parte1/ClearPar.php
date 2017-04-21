<?php
class ClearPar {

	public function build($cadena) {
		$array = str_split($cadena);
		$var = null;
		foreach ($array as $key => $fila) :
			if (empty($var)) :
				if ($fila === ")") :
					unset($array[$key]);
				else :
					$var = $fila;
				endif;
			else :
				if($var === "(") :
					if($fila === "(") :
						unset($array[$key]);
					else :
						$var = $fila;
					endif;
				else :
					if($fila === ")") :
						unset($array[$key]);
					else :
						$var = $fila;
					endif;
				endif;
			endif;
		endforeach;
		if (count($array) === 1)
			return "";
		$cadena = implode($array);
		return $cadena;
	}

}

echo "((()<br/>";
$algoritmo = new ClearPar();
echo $algoritmo->build("((()");