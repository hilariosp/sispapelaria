<?php

    require_once '../conexao.php';
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(0);


if(isset($_POST['enviar'])) {

    $nomeproduto = mb_strtoupper($_POST['nomeproduto']);
    $marcaproduto = $_POST['marcaproduto'];
    $categoriaproduto = $_POST['categoriaproduto'];
    $precoproduto = $_POST['precoproduto'];
    $qtproduto = $_POST['qtproduto'];

    $sql = "INSERT INTO produto (nomeproduto, marcaproduto, categoriaproduto, precoproduto, qtproduto)
    VALUES ('$nomeproduto', '$marcaproduto', '$categoriaproduto', '$precoproduto', '$qtproduto')";

    $sqlcombanco = $conexao->prepare($sql);

        if($sqlcombanco->execute()){
            echo "<script type='text/javascript'>
                    confirm('O produto {$nomeproduto} foi cadastrado com sucesso ');
                    window.location='index.php';
                </script>";
        }

}

if(isset($_POST['editar'])){

    ##dados recebidos pelo metodo POST
    $idproduto = $_POST["idproduto"];
    $nomeproduto = mb_strtoupper($_POST['nomeproduto']);
    $marcaproduto = $_POST['marcaproduto'];
    $categoriaproduto = $_POST['categoriaproduto'];
    $precoproduto = $_POST['precoproduto'];
    $qtproduto = $_POST['qtproduto'];

   
      ##codigo sql
      $sql = "UPDATE produto SET nomeproduto = :nomeproduto, marcaproduto = :marcaproduto, categoriaproduto = :categoriaproduto, 
      precoproduto = :precoproduto, qtproduto = :qtproduto WHERE idproduto = :idproduto";
   
    ##junta o codigo sql a conexao do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do parametros
    $sqlcombanco->bindParam(':idproduto',$idproduto, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':nomeproduto',$nomeproduto, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':marcaproduto', $marcaproduto, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':categoriaproduto', $categoriaproduto, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':precoproduto', $precoproduto, PDO::PARAM_STR);
    $sqlcombanco->bindParam(':qtproduto', $qtproduto, PDO::PARAM_INT);

    $sqlcombanco->execute();
 

    //CASO INSERIU DADOS NO BD MOSTRA MENSAGEM
    if($sqlcombanco->execute()){
            echo "<script type='text/javascript'>
                    confirm('O produto foi alterado com sucesso ');
                    window.location='index.php';
                </script>"; 

    }

}

if (isset($_POST['excluir'])) {

    $idproduto = $_POST["idproduto"];

    // Verificar se o produto está presente em vendas ou compras
    $sqlVerifica = "
        SELECT COUNT(*) as produtousado
        FROM (
            SELECT idproduto FROM venda WHERE idproduto = :idproduto
            UNION ALL
            SELECT idproduto FROM compra WHERE idproduto = :idproduto
        ) as result";

    $stmtVerifica = $conexao->prepare($sqlVerifica);
    $stmtVerifica->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
    $stmtVerifica->execute();

    $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

    // Se o produto está em vendas ou compras, impedir a exclusão
    if ($resultado['produtousado'] > 0) {
        echo "<script type='text/javascript'>
                alert('O produto não pode ser excluído, pois está associado a uma venda ou compra.');
                window.location='index.php';
              </script>";
    } else {
        // Se o produto não estiver em vendas ou compras, proceder com a exclusão
        $sql = "DELETE FROM produto WHERE idproduto = :idproduto";
        $sqlcombanco = $conexao->prepare($sql);
        $sqlcombanco->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);

        if ($sqlcombanco->execute()) {
            echo "<script type='text/javascript'>
                    alert('O produto foi excluído com sucesso.');
                    window.location='index.php';
                  </script>";
        }
    }
}
?>
