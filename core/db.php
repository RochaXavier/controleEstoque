<?php 
class db{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $db = "controle_estoque";

	function conectar(){
		$this->link = mysql_connect($this->host,$this->user,$this->password);
		if(!$this->link){
			print "ocorreu em Erro na conexão MySQL:";
			print "<b>".mysql_error()."</b>";
			die();
		} elseif(!mysql_select_db($this->db,$this->link)) {
			print "Ocorreu um Erro em selecionar o Banco";
			print "<b>".mysql_error()."</b>";
			die();
		}
	}

	function desconectar(){
		return mysql_close($this->link);
	}
}

?>