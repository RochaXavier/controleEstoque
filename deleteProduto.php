<?php
require_once '/core/crud.php';
require_once '/core/db.php';

$crud = new crud('produto');
if (isset($_POST['idProd'])) {
    $crud->delete("id = " . $_POST['idProd']);
}