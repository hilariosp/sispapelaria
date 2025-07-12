<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescompra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Editar Compras</title>
</head>
<body>
<?php
    // Inclui o arquivo de configuração
    require_once('../conexao.php');

    // Armazena o ID da compra
    if (isset($_GET['idcompra'])) {
        $idcompra = $_GET['idcompra'];
    } else {
        die("ID da compra não definido.");
    }

    // Busca os dados da compra
    $sql = "SELECT * FROM compra WHERE idcompra = :idcompra";
    $retorno = $conexao->prepare($sql);
    $retorno->bindParam(':idcompra', $idcompra, PDO::PARAM_INT);
    $retorno->execute();
    $array_retorno = $retorno->fetch(PDO::FETCH_ASSOC);

    // Armazena os dados da compra
    if ($array_retorno) {
        $idfornecedor = $array_retorno['idfornecedor'] ?? ''; // Evita erro caso a chave não exista
        $idproduto = $array_retorno['idproduto'] ?? '';
        $qtcproduto = $array_retorno['qtcproduto'] ?? '';
        $datacompra = $array_retorno['datacompra'] ?? '';
    } else {
        die("Compra não encontrada.");
    }
?>
<header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Editar Clientes</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudcompra.php" method="post">
                        <h2>Dados pessoais</h2>
                        <input type="hidden" name="idcompra" value="<?php echo htmlspecialchars($idcompra); ?>">
                        <label for="idfornecedor"><p>Nome do Fornecedor</p></label>
                        <select class="total" name="idfornecedor" required>
                            <option value=""></option>
                            <?php
                            // Seleciona os IDs e nomes dos fornecedores
                            $stmt_fornecedores = $conexao->prepare('SELECT idfornecedor, nomefornecedor FROM fornecedor');
                            $stmt_fornecedores->execute();
                            foreach ($stmt_fornecedores->fetchAll() as $fornecedor) { ?>
                                <option value="<?php echo htmlspecialchars($fornecedor['idfornecedor']); ?>" 
                                        <?php echo ($fornecedor['idfornecedor'] == $idfornecedor) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($fornecedor['nomefornecedor']); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="espacamento">
                            <label for="idproduto"><p>Produto</p></label>
                            <select class="medio" name="idproduto" required>
                                <option value=""></option>
                                <?php
                                // Seleciona os IDs e nomes dos produtos
                                $stmt_produtos = $conexao->prepare('SELECT idproduto, nomeproduto FROM produto');
                                $stmt_produtos->execute();
                                foreach ($stmt_produtos->fetchAll() as $produto) { ?>
                                    <option value="<?php echo htmlspecialchars($produto['idproduto']); ?>"
                                            <?php echo ($produto['idproduto'] == $idproduto) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($produto['nomeproduto']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="qtcproduto"><p>Quantidade</p></label>
                            <input class="pequenininho tirarseta" type="number" name="nova_qtcproduto" min="1" required value="<?php echo htmlspecialchars($qtcproduto); ?>">
                            <label for="datavenda"><p>Data da Compra</p></label>
                            <input class="fino" type="date" name="datacompra" required value="<?php echo htmlspecialchars($datacompra); ?>">
                        </div>

                <button name="editar" class="botaoform">Editar</button>
                    </form>
                    <nav class="nav-direita">
                        <a href="index.php"><button class="botaolink"><i class="fas fa-table"></i>Voltar para lista</button></nav>
                    </nav>
                </div>
            </div>
        </article>
    </div>
</body>
</html>