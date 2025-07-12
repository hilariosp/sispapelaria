<?php

define('HOST', 'localhost');   //endereço do BD
define('USUARIO', 'root');    // seu usuario do mysql
define('SENHA', '1234');    //sua senha do banco mysql
define('DBNAME', 'sispapelaria');

try {

    $conexao = new pdo('mysql:host=' . HOST . ';dbname=' .
                                     DBNAME, USUARIO, SENHA);
} catch (PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso.
     Erro gerado " . $e->getMessage();
}

?>
