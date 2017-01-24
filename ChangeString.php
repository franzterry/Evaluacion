<?php
class ChangeString {

	private $abecedario;

	public function __construct() {
		$this->abecedario = str_split("abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ");
	}

	private function modificar($cadena) {
		foreach ($this->abecedario as $key => $fila) {
			if ($fila === $cadena) :
				if ($cadena === "z")
					return $this->abecedario[0];
				if ($cadena === "Z")
					return $this->abecedario[28];
				return $this->abecedario[++$key];
			endif;
		}
		return $cadena;
	}

	public function build($cadena) {
		$array = str_split($cadena);
		foreach ($array as $key => $fila) :
			$array[$key] = $this->modificar($fila);
		endforeach;
		$cadena = implode("", $array);
		return $cadena;
	}

}

echo "**Casa 52Z<br/>";
$algoritmo = new ChangeString();
echo $algoritmo->build("**Casa 52Z");