<?php

    require_once '../conexao.php';

if(isset($_POST['enviar'])) {

    $nomefornecedor = mb_strtoupper($_POST['nomefornecedor']);
    $enderecofornecedor = mb_strtoupper($_POST['enderecofornecedor']); 
    $telefonefornecedor = $_POST['telefonefornecedor'];
    $emailfornecedor = mb_strtolower($_POST['emailfornecedor']);
    $cnpjfornecedor = $_POST['cnpjfornecedor'];

    $sql = "INSERT INTO fornecedor (nomefornecedor, enderecofornecedor, telefonefornecedor, emailfornecedor, cnpjfornecedor)
    VALUES ('$nomefornecedor', '$enderecofornecedor', '$telefonefornecedor', '$emailfornecedor', '$cnpjfornecedor')";

    $sqlcombanco = $conexao->prepare($sql);

    if($sqlcombanco->execute()){
        echo "<script type='text/javascript'>
                   confirm('O fornecedor {$nomefornecedor} foi cadastrado com sucesso ');
                  window.location='index.php';
              </script>";
    }

}

if(isset($_POST['editar'])){

    ##dados recebidos pelo metodo POST
    $idfornecedor = $_POST["idfornecedor"];
    $nomefornecedor = mb_strtoupper($_POST['nomefornecedor']);
    $enderecofornecedor = mb_strtoupper($_POST['enderecofornecedor']); 
    $telefonefornecedor = $_POST['telefonefornecedor'];
    $emailfornecedor = mb_strtolower($_POST['emailfornecedor']);
    $cnpjfornecedor = $_POST['cnpjfornecedor'];
   
      ##codigo sql
      $sql = "UPDATE fornecedor SET nomefornecedor = :nomefornecedor, enderecofornecedor = :enderecofornecedor,
      telefonefornecedor = :telefonefornecedor, emailfornecedor = :emailfornecedor, cnpjfornecedor = :cnpjfornecedor
      WHERE idfornecedor = :idfornecedor";
   
    ##junta o codigo sql a conexao do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $sqlcombanco->bindParam(':idfornecedor',$idfornecedor, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':nomefornecedor',$nomefornecedor, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':enderecofornecedor', $enderecofornecedor, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':telefonefornecedor', $telefonefornecedor, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':emailfornecedor', $emailfornecedor, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':cnpjfornecedor', $cnpjfornecedor, PDO::PARAM_INT);

    $sqlcombanco->execute();
 

    //CASO INSERIU DADOS NO BD MOSTRA MENSAGEM
    if($sqlcombanco->execute()){
            echo "<script type='text/javascript'>
                    confirm('O fornecedor {$nomefornecedor} foi alterado com sucesso ');
                    window.location='index.php';
                </script>"; 

    }

}

if(isset($_POST['excluir'])){

    $idfornecedor = $_POST["idfornecedor"];

    $sqlVerifica = "
    SELECT COUNT(*) as fornusado
    FROM (
        SELECT idfornecedor FROM compra WHERE idfornecedor = :idfornecedor
    ) as result";

    $stmtVerifica = $conexao->prepare($sqlVerifica);
    $stmtVerifica->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
    $stmtVerifica->execute();

    $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

// Se a fornecedor está em produto, impedir a exclusão
if ($resultado['fornusado'] > 0) {
    echo "<script type='text/javascript'>
            alert('O fornecedor não pode ser excluído, pois está associado a uma compra.');
            window.location='index.php';
          </script>";
} else {
    $sql = "DELETE FROM fornecedor WHERE idfornecedor = :idfornecedor ";

    $sqlcombanco = $conexao->prepare($sql);
    $sqlcombanco->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);

    if($sqlcombanco->execute())
    {
        echo "<script type='text/javascript'>
                confirm('O fornecedor foi excluído com sucesso ');
                window.location='index.php';
            </script>"; 

    }

}
}    
?>