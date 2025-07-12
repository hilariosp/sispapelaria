<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesprod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Cadastro de Compras</title>
</head>
<body>
    <header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Cadastro de Fornecedores</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudprod.php" method="post">
                    <h2>Dados do Produto</h2>

                    <label for="nomeproduto"><p>Nome do Produto</p></label>
                    <input type="text" class="total" name="nomeproduto" required>

                    <div class="espacamento">
                    <label for="marcaproduto"><p>Marca</p></label>
                    <select name="marcaproduto" class="medio" required>
                        <option value=""></option>
                        <?php
                        include '../conexao.php';
                        // Seleciona os IDs e nomes das marcas
                        $retorno = $conexao->prepare('SELECT idmarca, nomemarca FROM marca');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idmarca'])?>"><?php echo($value['nomemarca'])?></option>
                        <?php } ?>
                    </select>
                    <label for="categoriaproduto"><p>Categoria</p></label>
                    <select name="categoriaproduto" class="medio" required>
                        <option value=""></option>
                        <?php
                        // Seleciona os IDs e nomes das categorias
                        $retorno = $conexao->prepare('SELECT idcategoria, nomecategoria FROM categoria');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idcategoria'])?>"><?php echo($value['nomecategoria'])?></option>
                        <?php } ?>
                    </select>
                    
                    <label for="precoproduto"><p>Preço</p></label>
                    <input type="number" step="0.01" class="fino tirarseta" name="precoproduto" required>
                    
                    <label for="qtproduto"><p>Quantidade</p></label>
                    <input type="number" class="fino tirarseta" name="qtproduto" min="1" required>
                </div>
                <button class="botaoform" name="enviar">Inserir</button>
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