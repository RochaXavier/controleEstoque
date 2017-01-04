<?php

require_once '/core/conexao.php';
require_once '/core/crud.php';

$con = new conexao();
$con->conecta();
$crud = new crud("produto");

if (isset($_POST['idProd'])) {
    if($_POST['nomeEdic'] && $_POST['descEdic'] && $_POST['precEdic']){
        $crud->atualizar("nome = '".$_POST['nomeEdic']."', descricao = '".$_POST['descEdic']."',"
                . " preco = '".$_POST['precEdic']."'", "id = ".$_POST['idProd']);
        
        $con->desconecta();
    }
}