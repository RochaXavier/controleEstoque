<?php
include '/core/db.php';
include '/core/crud.php';
$pedidoCrud = new crud("pedido");

 if (isset($_POST['id_cliente']) && isset($_POST['id_produto'])) {
            if ($_POST['id_cliente'] && $_POST['id_produto']) {
                $valores = [];
                array_push($valores, $_POST['id_cliente']);
                array_push($valores, $_POST['id_produto']);
                if ($pedidoCrud->insert('id_cliente, id_produto', $valores)) {
                    echo "<script>alert('Inserido com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados!');</script>";
                }
            } else {
                echo "<script>alert('Informe todos os dados!!');</script>";
            }        
    }    
        header("Location: pedido.php");
?>
