<?php

include '/core/db.php';
include '/core/crud.php';

$crud = new crud("produto");

if (isset($_POST['idProd'])) {
    if($_POST['nomeEdic'] && $_POST['descEdic'] && $_POST['precEdic']){
        $crud->update("nome = '".$_POST['nomeEdic']."', descricao = '".$_POST['descEdic']."',"
                . " preco = '".$_POST['precEdic']."'", "id = ".$_POST['idProd']);
        
        $con->desconecta();
    }
}