<?php

class crud {

    protected $tabela = "";

    public function __construct($tabela) {
        $database = new db();
        $database->conectar();
        $this->tabela = $tabela;
        return $this->tabela;
    }

    function select($campos) {
        $query = "SELECT " . $campos . " FROM " . $this->tabela;

        $result = mysql_query($query);

        $resultado = [];

        while ($row = mysql_fetch_assoc($result)) {
            array_push($resultado, $row);
        }
        return $resultado;
    }

    function insert() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

}

?>