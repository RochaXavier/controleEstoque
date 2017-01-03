<?php
require_once '/core/conexao.php';
require_once '/core/crud.php';

$con = new conexao();
$con->conecta();
$crud = new crud('produto');
if (isset($_POST['idProd'])) {
    $crud->excluir("id = " . $_POST['idProd']);
    $con->desconecta();
}