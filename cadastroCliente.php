<?php
include '/core/db.php';
include '/core/crud.php';
$clienteCrud = new crud("cliente");

 if (isset($_POST['nomeCadastro']) && isset($_POST['emailCadastro']) && isset($_POST['telefoneCadastro'])) {
            if ($_POST['nomeCadastro'] && $_POST['emailCadastro'] && $_POST['telefoneCadastro']) {
                $valores = [];
                array_push($valores, $_POST['nomeCadastro']);
                array_push($valores, $_POST['emailCadastro']);
                array_push($valores, $_POST['telefoneCadastro']);
                if ($clienteCrud->insert('nome, email, telefone', $valores)) {
                    echo "<script>alert('Inserido com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados!');</script>";
                }
            } else {
                echo "<script>alert('Informe todos os dados!!');</script>";
            }        
    }
    
    header("Location: cliente.php");
?>