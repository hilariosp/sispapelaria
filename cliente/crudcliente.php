<?php

require_once '../conexao.php';

if(isset($_POST['enviar'])) {

    $nomecliente = mb_strtoupper($_POST['nomecliente']);
    $enderecocliente = mb_strtoupper($_POST['enderecocliente']);
    $emailcliente = mb_strtolower($_POST['emailcliente']);
    $telefonecliente = $_POST['telefonecliente'];

    $sql = "INSERT INTO cliente (nomecliente, enderecocliente, emailcliente, telefonecliente) VALUES
    ('$nomecliente', '$enderecocliente', '$emailcliente', '$telefonecliente')";

    $sqlcombanco = $conexao->prepare($sql);

    if($sqlcombanco->execute()){
        echo "<script type='text/javascript'>
                   alert('O cliente $nomecliente foi cadastrado com sucesso');
                   window.location='index.php';
              </script>";
    }

}

if(isset($_POST['editar'])){

    $idcliente = $_POST["idcliente"];
    $nomecliente = mb_strtoupper($_POST['nomecliente']);
    $enderecocliente = mb_strtoupper($_POST['enderecocliente']);
    $emailcliente = mb_strtolower($_POST['emailcliente']);
    $telefonecliente = $_POST['telefonecliente'];
   
    $sql = "UPDATE cliente SET nomecliente = :nomecliente, enderecocliente = :enderecocliente, emailcliente = :emailcliente, 
    telefonecliente = :telefonecliente WHERE idcliente = :idcliente ";
   
    $sqlcombanco = $conexao->prepare($sql);

    $sqlcombanco->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':nomecliente', $nomecliente, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':enderecocliente', $enderecocliente, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':emailcliente', $emailcliente, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':telefonecliente', $telefonecliente, PDO::PARAM_STR);

    if($sqlcombanco->execute()){
        echo "<script type='text/javascript'>
                alert('O cliente $nomecliente foi alterado com sucesso');
                window.location='index.php';
              </script>"; 
    }

}

if(isset($_POST['excluir'])){

    $idcliente = $_POST["idcliente"];

    $sqlVerifica = "
    SELECT COUNT(*) as clienteusado
    FROM (
        SELECT idcliente FROM venda WHERE idcliente = :idcliente
    ) as result";

    $stmtVerifica = $conexao->prepare($sqlVerifica);
    $stmtVerifica->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
    $stmtVerifica->execute();

    $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

    if ($resultado['clienteusado'] > 0) {
        echo "<script type='text/javascript'>
                alert('O cliente não pode ser excluído, pois está associado a uma venda.');
                window.location='index.php';
              </script>";
    } else {

        $sql = "DELETE FROM cliente WHERE idcliente = :idcliente ";

        $sqlcombanco = $conexao->prepare($sql);
        $sqlcombanco->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

        if($sqlcombanco->execute()) {
            echo "<script type='text/javascript'>
                    alert('O cliente foi excluído com sucesso');
                    window.location='index.php';
                  </script>"; 
        }

    }
}

?>
