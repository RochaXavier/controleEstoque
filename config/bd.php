<?php 
$conecta = mysql_connect("localhost", "root", "") or print (mysql_error()); 
$db =  mysql_select_db('controle_estoque', $conecta);

if (!$db) {
	die ('Can\'t use foo : ' . mysql_error());
}

?>