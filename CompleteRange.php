<?php
class CompleteRange {

	public function build($numero) {
		$numero = str_replace("[", "", $numero);
		$numero = str_replace("]", "", $numero);
		$array = explode(",", $numero);
		asort($array);
		$var = null;
		foreach ($array as $key => $fila) :
			if (empty($var)):
				$var = $fila;
			else :
				if (++$var != $fila) :
					for ($i = $var; $i < $fila; $i++) :
						array_push($array, $i++);
					endfor;
				endif;
				$var = $fila;
			endif;
		endforeach;
		asort($array);
		$numero = implode(",", $array);
		$numero = "[".$numero."]";
		return $numero;
	}

}

echo "[55, 58, 60, 51]<br/>";
$algoritmo = new CompleteRange();
echo $algoritmo->build("[55, 58, 60, 51]");