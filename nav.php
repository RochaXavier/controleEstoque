 <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Controle de pedidos</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li <?php if(strpos($_SERVER["REQUEST_URI"], "produto.php")!==false){echo "class='active'";} ?>><a id="telaProduto" href= 'produto.php'">Produtos</a></li>
          <li <?php if(strpos($_SERVER["REQUEST_URI"], "cliente.php")!==false){echo "class='active'";} ?>><a id="telaCliente" href= 'cliente.php'">Clientes</a></li>     
          <li <?php if(strpos($_SERVER["REQUEST_URI"], "pedido.php")!==false){echo "class='active'";} ?>><a id="telaPedidos" href = 'pedido.php'">Pedidos</a></li>               
      </ul>

  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>