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
	<?php 
	include '/config/bd.php';

	$produtos =  mysql_query('SELECT * FROM produto', $conecta);
	?>


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
				while ($row = mysql_fetch_assoc($produtos)) {

					?>
					<tr>
						<td><?php  echo $row['id']; ?></td>
						<td><?php  echo $row['nome']; ?></td>
						<td><?php  echo $row['preco']; ?></td>
						<td><?php  echo $row['descricao']; ?></td>
						<td>
							<button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalEdicao">Editar</button>
						</td> 
						<td>
							<button class="btn btn-sm btn-default" data-toggle="modal"  data-target="#modalExclucao">Excluir</button>'
						</td>
						</tr>
					<?php } ?>				
				</tbody>
			</table>
		</div>



		<!--formulario de cadastro do produto-->
		<div class="modal fade" id="modalCadastro" style="display: none">
			<form>
				<input type="text" name="nome">
				<input type="text" name="descricao">
				<input type="number" name="preco" step="0.1">
				<input type="submit" name="cadastrarProduto">
			</form>
		</div>

		<!--formulario de edição de produto-->
		<div class="modal fade" id="modalEdicao" style="display: none">

			<form>
				<input type="text" name="nome">
				<input type="text" name="descricao">
				<input type="number" name="preco" step="0.1">
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
