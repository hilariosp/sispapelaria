<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescompra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Cadastro de Compras</title>
</head>
<body>
    <header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Cadastro de Compras</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudcompra.php" method="post">
                        <h2>Dados pessoais</h2>
                        <label for="idfornecedor"><p>Nome do Fornecedor</p></label>
                        <select class="total" name="idfornecedor" required>
                        <option value=""></option>
                        <?php
                        include '../conexao.php';
                        // Seleciona os IDs e nomes dos fornecedores
                        $retorno = $conexao->prepare('SELECT idfornecedor, nomefornecedor FROM fornecedor');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idfornecedor'])?>"><?php echo($value['nomefornecedor'])?></option>
                        <?php } ?>
                        </select>
                        <div class="espacamento">
                            <label for="idproduto"><p>Produto</p></label>
                            <select class="medio" name="idproduto" required>
                        <option value=""></option>
                        <?php
                        include '../conexao.php';
                        // Seleciona os IDs e nomes dos produtos
                        $retorno = $conexao->prepare('SELECT idproduto, nomeproduto FROM produto');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idproduto'])?>"><?php echo($value['nomeproduto'])?></option>
                        <?php } ?>
                        </select>
                            <label for="qtcproduto"><p>Quantidade</p></label>
                            <input class="pequenininho tirarseta" type="number" name="qtcproduto" min="1" required>
                            <label for="datavenda"><p>Data da Compra</p></label>
                            <input class="fino" type="date" name="datacompra" required>
                        </div>
                        <button name="enviar" class="botaoform">Inserir</button>

                    </form>
                    <nav class="nav-direita">
                        <a href="index.php"><button class="botaolink"><i class="fas fa-table"></i>Ver lista</button></nav>
                    </nav>
                </div>
            </div>
        </article>
    </div>
</body>
</html>