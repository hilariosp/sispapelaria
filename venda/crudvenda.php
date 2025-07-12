<?php
include '../conexao.php'; // Inclui o arquivo de configuração

if(isset($_POST['enviar'])) {
    // Recebe os dados do formulário
    $idcliente = ($_POST['idcliente']);
    $idproduto = ($_POST['idproduto']);
    $qtvproduto = isset($_POST['qtvproduto']) ? (int)$_POST['qtvproduto'] : 0;
    $datavenda = $_POST['datavenda'];
    $descontoproduto = isset($_POST['descontoproduto']) ? (float)$_POST['descontoproduto'] : 0;

    // Buscar o preço do produto e a quantidade disponível
    $stmt_produto = $conexao->prepare("SELECT precoproduto, qtproduto FROM produto WHERE idproduto = ?");
    $stmt_produto->bindParam(1, $idproduto);
    $stmt_produto->execute();
    $produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Erro: Produto não encontrado.";
        exit;
    }

    $precoproduto = $produto['precoproduto'];
    $qtproduto_disponivel = $produto['qtproduto'];

    // Verificar se a quantidade disponível é suficiente
    if ($qtvproduto > $qtproduto_disponivel) {
        echo "<script type='text/javascript'>
            alert('Erro: Quantidade em estoque insuficiente.');
            window.location='cadvenda.php';
        </script>";
        exit;
    }

    // Calcular o preço total da venda
    $desconto = $descontoproduto / 100;
    $precovenda = $qtvproduto * $precoproduto * (1 - $desconto);

    // Inserir a venda na base de dados
    $sql_venda = "INSERT INTO venda (idcliente, idproduto, qtvproduto, datavenda, descontoproduto, precovenda) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_venda = $conexao->prepare($sql_venda);
    $stmt_venda->bindParam(1, $idcliente);
    $stmt_venda->bindParam(2, $idproduto);
    $stmt_venda->bindParam(3, $qtvproduto);
    $stmt_venda->bindParam(4, $datavenda);
    $stmt_venda->bindParam(5, $descontoproduto);
    $stmt_venda->bindParam(6, $precovenda);

    if ($stmt_venda->execute()) {
        // Atualiza o estoque
        $sql_atualizar = "UPDATE produto SET qtproduto = qtproduto - ? WHERE idproduto = ?";
        $stmt_atualizar = $conexao->prepare($sql_atualizar);
        $stmt_atualizar->bindParam(1, $qtvproduto);
        $stmt_atualizar->bindParam(2, $idproduto);
        $stmt_atualizar->execute();

        echo "<script type='text/javascript'>
            confirm('A venda foi cadastrada com sucesso');
            window.location='index.php';
        </script>";
    } else {
        echo "Erro ao registrar a venda: " . $conexao->error;
    }

    $stmt_venda->close();
    $stmt_atualizar->close();
    $conexao->close();
}

if (isset($_POST['editar'])) {
    // Recebe os dados do formulário para editar
    $idvenda = $_POST['idvenda'];
    $idproduto = $_POST['idproduto'];
    $idcliente = $_POST['idcliente'];
    $datavenda = $_POST['datavenda'];
    $nova_qtvproduto = isset($_POST['nova_qtvproduto']) ? (int)$_POST['nova_qtvproduto'] : 0;
    $novo_descontoproduto = isset($_POST['novo_descontoproduto']) ? (float)$_POST['novo_descontoproduto'] : null;

    // Buscar a venda existente
    $stmt_venda = $conexao->prepare("SELECT idproduto, qtvproduto, descontoproduto FROM venda WHERE idvenda = ?");
    $stmt_venda->bindParam(1, $idvenda);
    $stmt_venda->execute();
    $venda = $stmt_venda->fetch(PDO::FETCH_ASSOC);

    if (!$venda) {
        echo "Erro: Venda não encontrada.";
        exit;
    }

    $idproduto = $venda['idproduto'];
    $qtproduto_venda = $venda['qtvproduto'];
    $desconto_venda = $venda['descontoproduto'];

    // Buscar o preço do produto e a quantidade disponível
    $stmt_produto = $conexao->prepare("SELECT precoproduto, qtproduto FROM produto WHERE idproduto = ?");
    $stmt_produto->bindParam(1, $idproduto);
    $stmt_produto->execute();
    $produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Erro: Produto não encontrado.";
        exit;
    }

    $precoproduto = $produto['precoproduto'];
    $qtproduto_disponivel = $produto['qtproduto'];

    // Calcular o estoque ajustado
    $estoque_atualizado = $qtproduto_disponivel + $qtproduto_venda - $nova_qtvproduto;

    // Verificar se a nova quantidade é suficiente
    if ($nova_qtvproduto > $estoque_atualizado) {
        echo "<script type='text/javascript'>
            alert('Erro: Quantidade em estoque insuficiente.');
            window.location='cadvenda.php';
        </script>";
        exit;
    }

    // Preservar desconto anterior se não for fornecido novo valor
    if (is_null($novo_descontoproduto)) {
        $novo_descontoproduto = $desconto_venda;
    }

    // Calcular o novo preço total da venda
    $novo_desconto = $novo_descontoproduto / 100;
    $novo_precovenda = $nova_qtvproduto * $precoproduto * (1 - $novo_desconto);

    // Atualizar a venda na base de dados
    $sql_atualizar_venda = "UPDATE venda SET idcliente = ?, idproduto = ?, qtvproduto = ?, descontoproduto = ?, precovenda = ?,
    datavenda = ? WHERE idvenda = ?";
    $stmt_atualizar_venda = $conexao->prepare($sql_atualizar_venda);
    $stmt_atualizar_venda->bindParam(1, $idcliente);
    $stmt_atualizar_venda->bindParam(2, $idproduto);
    $stmt_atualizar_venda->bindParam(3, $nova_qtvproduto);
    $stmt_atualizar_venda->bindParam(4, $novo_descontoproduto);
    $stmt_atualizar_venda->bindParam(5, $novo_precovenda);
    $stmt_atualizar_venda->bindParam(6, $datavenda);
    $stmt_atualizar_venda->bindParam(7, $idvenda);

    if ($stmt_atualizar_venda->execute()) {
        // Atualizar o estoque
        $sql_atualizar_estoque = "UPDATE produto SET qtproduto = ? WHERE idproduto = ?";
        $stmt_atualizar_estoque = $conexao->prepare($sql_atualizar_estoque);
        $stmt_atualizar_estoque->bindParam(1, $estoque_atualizado);
        $stmt_atualizar_estoque->bindParam(2, $idproduto);
        $stmt_atualizar_estoque->execute();

        echo "<script type='text/javascript'>
            confirm('A venda foi atualizada com sucesso');
            window.location='index.php';
        </script>";
    } else {
        echo "Erro ao atualizar a venda: " . $conexao->error;
    }

    $stmt_atualizar_venda->close();
    $stmt_atualizar_estoque->close();
    $conexao->close();
}

if (isset($_POST['excluir'])) {
    $idvenda = $_POST['idvenda'];

    // Recuperar os itens da venda
    $sql = "SELECT idproduto, qtvproduto FROM venda WHERE idvenda = :idvenda";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
    $stmt->execute();

    $itensVenda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($itensVenda) {
        // Restaurar o estoque dos produtos vendidos
        foreach ($itensVenda as $item) {
            $idproduto = $item['idproduto'];
            $qtvproduto = $item['qtvproduto'];

            $sqlUpdateEstoque = "UPDATE produto SET qtproduto = qtproduto + :qtvproduto WHERE idproduto = :idproduto";
            $stmtUpdateEstoque = $conexao->prepare($sqlUpdateEstoque);
            $stmtUpdateEstoque->bindParam(':qtvproduto', $qtvproduto, PDO::PARAM_INT);
            $stmtUpdateEstoque->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);
            $stmtUpdateEstoque->execute();
        }

        // Excluir a venda
        $sqlDeleteVenda = "DELETE FROM venda WHERE idvenda = :idvenda";
        $stmtDeleteVenda = $conexao->prepare($sqlDeleteVenda);
        $stmtDeleteVenda->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);

        if ($stmtDeleteVenda->execute()) {
            echo "<script type='text/javascript'>
                    confirm('A venda foi excluída com sucesso!');
                    window.location='index.php';
                </script>";
        } else {
            echo "Erro ao excluir a venda.";
        }
    } else {
        echo "Erro: Venda não encontrada.";
    }
}
?>