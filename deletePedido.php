<?php
require_once '/core/crud.php';
require_once '/core/db.php';

$crud = new crud('pedido');
if (isset($_POST['id'])) {
    $crud->delete("id = ". $_POST['id']);
}

?>