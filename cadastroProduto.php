<?php
include '/core/db.php';
include '/core/crud.php';
$produtoCrud = new crud("produto");

 if (isset($_POST['nomeInsercao']) && isset($_POST['descricaoInsercao']) && isset($_POST['precoInsercao'])) {
            if ($_POST['nomeInsercao'] && $_POST['descricaoInsercao'] && $_POST['precoInsercao']) {
                $valores = [];
                array_push($valores, $_POST['nomeInsercao']);
                array_push($valores, $_POST['descricaoInsercao']);
                array_push($valores, $_POST['precoInsercao']);
                if ($produtoCrud->insert('nome, descricao, preco', $valores)) {
                    echo "<script>alert('Inserido com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados!');</script>";
                }
            } else {
                echo "<script>alert('Informe todos os dados!!');</script>";
            }        
    }
    
        header("Location: produto.php");
?>