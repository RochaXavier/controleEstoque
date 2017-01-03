<?php

class crud {
	protected $tabela = "";

	public function __construct($tabela) {
		$database = new db();
		$database->conectar();
		$this->tabela = $tabela;
		return $this->tabela;
	}

	function select($campos, $where = NULL, $table = NULL) {

		if($table){
			$this->tabela = $table;
		}

		if($where){
			$query = "SELECT " . $campos . " FROM " . $this->tabela." WHERE ".$where;
		}else{
			$query = "SELECT " . $campos . " FROM " . $this->tabela;
		}    
		//echo $query. "<br>";
		
		$result = mysql_query($query);
		$resultado = [];



		while ($row = mysql_fetch_assoc($result)) {
			array_push($resultado, $row);
		}
		return $resultado;
	}

	function insert($campos, $valores, $where = NULL, $table = NULL) {

		if($table){
			$this->tabela = $table;
		}
		$valores = implode("','", $valores);
		
		if($where){
			$query = "INSERT INTO " . $this->tabela . " (" . $campos . ") " . "VALUES ('" . $valores . "') WHERE ".$where;        
		}else{
			$query = "INSERT INTO " . $this->tabela . " (" . $campos . ") " . "VALUES ('" . $valores . "')";                    
		}
		
		if (mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}

	function update($campoValores, $where = NULL, $table = NULL) {

		if($table){
			$this->tabela = $table;
		}
		if($where){
			$query = "UPDATE ".$this->tabela." SET ".$campoValores." WHERE ".$where;
		}else{
			$query = "UPDATE ".$this->tabela." SET ".$campoValores;
		}
		echo $query;
		if (mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}

	function delete($where, $table = NULL) {

		if($table){
			$this->tabela = $table;
		}
		$query = "DELETE FROM ".$this->tabela." WHERE ".$where;		
		echo $query;
		
		if (mysql_query($query)) {
			return true;
		} else {
			return false;
		}
	}
}

?>
