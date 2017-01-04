<?php

require_once '/core/conexao.php';
require_once '/core/crud.php';

$con = new conexao();
$con->conecta();
$crud = new crud("cliente");
/*
echo $_POST['idClie'].' - '.$_POST['nomeEdic'].' - '.$_POST['emailEdic'].' - '.$_POST['telEdic'];
exit();
*/
if (isset($_POST['idClie'])) {
    if($_POST['nomeEdic'] && $_POST['emailEdic'] && $_POST['telEdic']){
        $crud->atualizar("nome = '".$_POST['nomeEdic']."', email = '".$_POST['emailEdic']."',"
                . " telefone = '".$_POST['telEdic']."'", "id = ".$_POST['idClie']);
        
        $con->desconecta();
    }
}