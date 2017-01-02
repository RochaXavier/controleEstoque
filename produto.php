<?php
include '/core/db.php';
include '/core/crud.php';
$produtoCrud = new crud("produto");
$produtos = $produtoCrud->select("*");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produtos</title>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>	

        
        $con = new conexao();
        $con->conecta();
        $crud = new crud('produto');
        
        if(isset($_POST['nomeInsercao']) && isset($_POST['descricaoInsercao']) && isset($_POST['precoInsercao'])){
            echo'tem coisa';
            $valores = [];
            array_push($valores, $_POST['nomeInsercao']);
            array_push($valores, $_POST['descricaoInsercao']);
            array_push($valores, $_POST['precoInsercao']);
            echo '<prep>';
            echo $valores;
            echo '</prep>';
            exit();
            if($crud->inserir('nome, descricao, preco', $valores)){
                echo "<script>alert('Inserido com sucesso!');</script>";                
            }
        }
                
	$produtos = $crud->seleciona("*");
        
        <h1>Lista de produtos</h1>
        <!--tabela de produtos cadatrados-->
        <div class="container">
            <button id="novoProduto" class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalCadastro">Cadastrar Produto</button>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <!--tr com dados do banco-->
                <tbody>
                    <?php
                    foreach ($produtos as $produto) {
                        ?>
                        <tr>
                            <td><?= $produto['id']; ?></td>
                            <td><?= $produto['nome']; ?></td>
                            <td><?= $produto['preco']; ?></td>
                            <td><?= $produto['descricao']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalEdicao">Editar</button>
                            </td> 
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalExclucao">Excluir</button>
                            </td>
                        </tr>
                    <?php } ?>				
                </tbody>
            </table>
        </div>



        <!--formulario de cadastro do produto-->
        <div class="modal fade" id="modalCadastro" style="display: none">
            <form method="POST">
                <label>Nome:</label>
                <input type="text" name="nomeInsercao">
                <label>Descrição:</label>
                <input type="text" name="descricaoInsercao">
                <label>Preço: </label>
                <input type="number" name="precoInsercao" step="0.1">                            
                <input type="submit" name="cadastrarProduto">
            </form>
        </div>

        <!--formulario de edição de produto-->
        <div class="modal fade" id="modalEdicao" style="display: none">
            <form>
                <label>Nome:</label>
                <input type="text" name="nomeEdicao">
                <label>Descrição:</label>
                <input type="text" name="descricaoEdicao">
                <label>Preço:</label>
                <input type="number" name="precoEdicao" step="0.1">
                <input type="submit" name="edicaoProduto">
            </form>		
        </div>

        <div class="modal fade" id="modalExclucao" style="display: none">
            <p>Realmente gostaria de excluir esse item?</p>
            <button>Sim</button>
            <button>Nao</button>
        </div>


    </body>
</html>
