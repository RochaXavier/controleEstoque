<?php

class crud {

	protected $tabela = "";

	public function __construct($tabela) {
		$database = new db();
		$database->conectar();
		$this->tabela = $tabela;
		return $this->tabela;
	}

	function select($campos) {
		$query = "SELECT " . $campos . " FROM " . $this->tabela;

		$result = mysql_query($query);

		$resultado = [];

		while ($row = mysql_fetch_assoc($result)) {
			array_push($resultado, $row);
		}
		return $resultado;
		return true;
	}

	function insert($campos, $valores) {
		$valores = implode("','", $valores);
		$query = "INSERT INTO " . $this->tabela . " (" . $campos . ") " . "VALUES ('" . $valores . "')";                
		if (mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}

	function update() {
		
	}

	function delete() {
		
	}

}

?>