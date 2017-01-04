<?php

require_once '/core/db.php';
require_once '/core/crud.php';

$crud = new crud("cliente");

if (isset($_POST['idClie'])) {
    if($_POST['nomeEdic'] && $_POST['emailEdic'] && $_POST['telEdic']){
        $crud->update("nome = '".$_POST['nomeEdic']."', email = '".$_POST['emailEdic']."',"
                . " telefone = '".$_POST['telEdic']."'", "id = ".$_POST['idClie']);
    }
}