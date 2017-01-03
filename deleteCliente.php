<?php
require_once '/core/crud.php';
require_once '/core/db.php';

$crud = new crud('cliente');
if (isset($_POST['idClie'])) {
    $crud->delete("id = " . $_POST['idClie']);
}
?>