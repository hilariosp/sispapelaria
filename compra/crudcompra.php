<?php

    require_once '../conexao.php';

if(isset($_POST['enviar'])) {

    $idfornecedor = $_POST["idfornecedor"];
    $idproduto = $_POST["idproduto"];
    $qtcproduto = $_POST['qtcproduto'];
    $datacompra = $_POST['datacompra'];


    $sql = "INSERT INTO compra (idfornecedor, idproduto, qtcproduto, datacompra) VALUES
    ('$idfornecedor', '$idproduto', '$qtcproduto', '$datacompra')";
    $sqlcombanco = $conexao->prepare($sql);


    if($sqlcombanco->execute()){

        $sql_atualizar = "UPDATE produto SET qtproduto = qtproduto + ? WHERE idproduto = ?";
        $stmt_atualizar = $conexao->prepare($sql_atualizar);
        $stmt_atualizar->bindParam(1, $qtcproduto, PDO::PARAM_INT);
        $stmt_atualizar->bindParam(2, $idproduto, PDO::PARAM_STR);
        $stmt_atualizar->execute();

        echo "<script type='text/javascript'>
                   confirm('A compra do produto foi cadastrada com sucesso ');
                  window.location='index.php';
              </script>";
    }
}    

if(isset($_POST['editar'])){

    $idcompra = $_POST["idcompra"];
    $idfornecedor = $_POST["idfornecedor"];
    $idproduto = $_POST["idproduto"];
    $nova_qtcproduto = $_POST['nova_qtcproduto'];
    $datacompra = $_POST['datacompra'];

    // Buscar a compra existente
    $stmt_compra = $conexao->prepare("SELECT idproduto, qtcproduto FROM compra WHERE idcompra = ?");
    $stmt_compra->bindParam(1, $idcompra);
    $stmt_compra->execute();
    $compra = $stmt_compra->fetch(PDO::FETCH_ASSOC);
            
    if (!$compra) {
        echo "Erro: Compra não encontrada.";
        exit;
    }
            
    $idproduto = $compra['idproduto'];
    $qtproduto_compra = $compra['qtcproduto'];

    $stmt_produto = $conexao->prepare("SELECT qtproduto FROM produto WHERE idproduto = ?");
    $stmt_produto->bindParam(1, $idproduto);
    $stmt_produto->execute();
    $produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

    $qtproduto_disponivel = $produto['qtproduto'];

    // Calcular o estoque ajustado
    $estoque_atualizado = $qtproduto_disponivel - $qtproduto_compra + $nova_qtcproduto;

    // Atualizar a tabela de compras
    $sql_atualizar_compra = "UPDATE compra SET idfornecedor = ?, idproduto = ?, qtcproduto = ?, datacompra = ? WHERE idcompra = ?";
    $stmt_atualizar_compra = $conexao->prepare($sql_atualizar_compra);
    $stmt_atualizar_compra->bindParam(1, $idfornecedor);
    $stmt_atualizar_compra->bindParam(2, $idproduto);
    $stmt_atualizar_compra->bindParam(3, $nova_qtcproduto);
    $stmt_atualizar_compra->bindParam(4, $datacompra);
    $stmt_atualizar_compra->bindParam(5, $idcompra);
            
    if ($stmt_atualizar_compra->execute()) {
        // Atualizar o estoque
        $sql_atualizar_estoque = "UPDATE produto SET qtproduto = ? WHERE idproduto = ?";
        $stmt_atualizar_estoque = $conexao->prepare($sql_atualizar_estoque);
        $stmt_atualizar_estoque->bindParam(1, $estoque_atualizado);
        $stmt_atualizar_estoque->bindParam(2, $idproduto);
        $stmt_atualizar_estoque->execute();

        echo "<script type='text/javascript'>
            confirm('A compra foi atualizada com sucesso');
            window.location='index.php';
        </script>";
    } else {
        echo "Erro ao atualizar a compra: " . $conexao->error;
    }

    $stmt_atualizar_compra->close();
    $stmt_atualizar_estoque->close();
    $conexao->close();


}

if(isset($_POST['excluir'])){

    $idcompra = $_POST["idcompra"];

    // Recuperar os itens da compra
    $sql = "SELECT idproduto, qtcproduto FROM compra WHERE idcompra = :idcompra";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':idcompra', $idcompra, PDO::PARAM_INT);
    $stmt->execute();

    $itensCompra = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($itensCompra) {
        // Restaurar o estoque dos produtos comprados
        foreach ($itensCompra as $item) {
            $idproduto = $item['idproduto'];
            $qtcproduto = $item['qtcproduto'];

            $sqlUpdateEstoque = "UPDATE produto SET qtproduto = qtproduto - :qtcproduto WHERE idproduto = :idproduto";
            $stmtUpdateEstoque = $conexao->prepare($sqlUpdateEstoque);
            $stmtUpdateEstoque->bindParam(':qtcproduto', $qtcproduto, PDO::PARAM_INT);
            $stmtUpdateEstoque->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
            $stmtUpdateEstoque->execute();
        }

    $sql = "DELETE FROM compra WHERE idcompra = :idcompra";

    $sqlcombanco = $conexao->prepare($sql);
    $sqlcombanco->bindParam(':idcompra', $idcompra, PDO::PARAM_INT);


    if($sqlcombanco->execute())
    {

        echo "<script type='text/javascript'>
                confirm('A compra foi excluída com sucesso!');
                window.location='index.php';
            </script>"; 

    }

}
}
?>
