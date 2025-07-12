<?php

    require_once '../conexao.php';

if(isset($_POST['enviar'])) {

    $nomemarca = mb_strtoupper($_POST['nomemarca']);

    $sql = "INSERT INTO marca (nomemarca) VALUES ('$nomemarca')";

    $sqlcombanco = $conexao->prepare($sql);

    if($sqlcombanco->execute()){
        echo "<script type='text/javascript'>
                   confirm('A marca {$nomemarca} foi cadastrada com sucesso ');
                  window.location='index.php';
              </script>";
    }

}

if(isset($_POST['editar'])){

    ##dados recebidos pelo metodo POST
    $idmarca = $_POST["idmarca"];
    $nomemarca = mb_strtoupper($_POST["nomemarca"]);
   
      ##codigo sql
    $sql = "UPDATE marca SET nomemarca = :nomemarca WHERE idmarca= :idmarca ";
   
    ##junta o codigo sql a conexao do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $sqlcombanco->bindParam(':idmarca',$idmarca, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':nomemarca',$nomemarca, PDO::PARAM_STR);
    $sqlcombanco->execute();
 

    //CASO INSERIU DADOS NO BD MOSTRA MENSAGEM
    if($sqlcombanco->execute()){
            echo "<script type='text/javascript'>
                    confirm('A marca {$nomemarca} foi alterada com sucesso ');
                    window.location='index.php';
                </script>"; 

    }

}

if(isset($_POST['excluir'])){

    $idmarca = $_POST["idmarca"];
    $sqlVerifica = "
    SELECT COUNT(*) as marcausada
    FROM (
        SELECT marcaproduto FROM produto WHERE marcaproduto = :idmarca
    ) as result";

    $stmtVerifica = $conexao->prepare($sqlVerifica);
    $stmtVerifica->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
    $stmtVerifica->execute();

    $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

// Se a marca está em produto, impedir a exclusão
if ($resultado['marcausada'] > 0) {
    echo "<script type='text/javascript'>
            alert('A marca não pode ser excluída, pois está associada a um produto.');
            window.location='index.php';
          </script>";
} else {

    $sqlProduto = "DELETE FROM produto WHERE marcaproduto = :idmarca";
    $sqlProdutoCombanco = $conexao->prepare($sqlProduto);
    $sqlProdutoCombanco->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
    $sqlProdutoCombanco->execute();

    $sql = "DELETE FROM marca WHERE idmarca = :idmarca ";

    $sqlcombanco = $conexao->prepare($sql);
    $sqlcombanco->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);

    if($sqlcombanco->execute())
    {
        echo "<script type='text/javascript'>
                confirm('A marca foi excluída com sucesso ');
                window.location='index.php';
            </script>"; 

    }

}
}

?>