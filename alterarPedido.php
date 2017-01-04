<?php

include '/core/db.php';
include '/core/crud.php';

$crud = new crud("pedido");

if (isset($_POST['idPedi'])) {
    if($_POST['idProd'] && $_POST['idClie']){
        $crud->update("id_cliente = '".$_POST['idClie']."', id_produto = '".$_POST['idProd']."'", " id = ".$_POST['idPedi']);
    }
}