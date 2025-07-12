<?php

    require_once '../conexao.php';

if(isset($_POST['enviar'])) {

    $nomecategoria = mb_strtoupper($_POST['nomecategoria']);

    $sql = "INSERT INTO categoria (nomecategoria) VALUES ('$nomecategoria')";

    $sqlcombanco = $conexao->prepare($sql);

    if($sqlcombanco->execute()){
        echo "<script type='text/javascript'>
                   confirm('A categoria {$nomecategoria} foi cadastrada com sucesso ');
                  window.location='index.php';
              </script>";
    }

}

if(isset($_POST['editar'])){

    ##dados recebidos pelo metodo POST
    $idcategoria = $_POST["idcategoria"];
    $nomecategoria = mb_strtoupper($_POST["nomecategoria"]);
   
      ##codigo sql
    $sql = "UPDATE  categoria SET nomecategoria = :nomecategoria WHERE idcategoria= :idcategoria ";
   
    ##junta o codigo sql a conexao do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $sqlcombanco->bindParam(':idcategoria',$idcategoria, PDO::PARAM_INT);
    $sqlcombanco->bindParam(':nomecategoria',$nomecategoria, PDO::PARAM_STR);
    $sqlcombanco->execute();
 

    //CASO INSERIU DADOS NO BD MOSTRA MENSAGEM
    if($sqlcombanco->execute()){
            echo "<script type='text/javascript'>
                    confirm('A categoria {$nomecategoria} foi alterada com sucesso ');
                    window.location='index.php';
                </script>"; 

    }

}

if(isset($_POST['excluir'])){

    $idcategoria = $_POST['idcategoria'];
    $sqlVerifica = "
    SELECT COUNT(*) as catusado
    FROM (
        SELECT categoriaproduto FROM produto WHERE categoriaproduto = :idcategoria
    ) as result";

    $stmtVerifica = $conexao->prepare($sqlVerifica);
    $stmtVerifica->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);
    $stmtVerifica->execute();

    $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);

// Se a categoria está em produto, impedir a exclusão
if ($resultado['catusado'] > 0) {
    echo "<script type='text/javascript'>
            alert('A categoria não pode ser excluída, pois está associada a um produto.');
            window.location='index.php';
          </script>";
} else {

    $sql = "DELETE FROM categoria WHERE idcategoria = :idcategoria ";

    $sqlcombanco = $conexao->prepare($sql);
    $sqlcombanco->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);

    if($sqlcombanco->execute())
    {
        echo "<script type='text/javascript'>
                confirm('A categoria foi excluída com sucesso ');
                window.location='index.php';
            </script>"; 

    }

}
}
?>

