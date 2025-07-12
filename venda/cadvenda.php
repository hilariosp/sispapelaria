<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesvenda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Cadastro de Vendas</title>
</head>
<body>
<header>
    <h1><a href="../index.php">PaperSuite</a></h1>
</header>
    <article>
        <h1>Cadastro de Vendas</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudvenda.php" method="post">
                    <h2>Dados da Venda</h2>
                <label for="idcliente">Nome do Cliente</label>
                <select class="total" name="idcliente" required>
                        <option value=""></option>
                        <?php
                        include '../conexao.php';
                        // Seleciona os IDs e nomes dos clientes
                        $retorno = $conexao->prepare('SELECT idcliente, nomecliente FROM cliente');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idcliente'])?>"><?php echo($value['nomecliente'])?></option>
                        <?php } ?>
                </select>
                
                <div class="espacamento">
                <label for="idproduto">Produto</label>
                <select class="largo" name="idproduto" id="idproduto" onchange="mostrarPreco()" required>
                        <option value=""></option>
                        <?php
                        // Seleciona os IDs, nomes e preços dos produtos
                        $retorno = $conexao->prepare('SELECT idproduto, nomeproduto, precoproduto FROM produto');
                        $retorno->execute();

                        foreach($retorno->fetchAll() as $value) { ?>
                            <option value="<?php echo($value['idproduto'])?>" data-preco="<?php echo($value['precoproduto'])?>"><?php echo($value['nomeproduto'])?></option>
                        <?php } ?>
                </select>
                <label for="datavenda">Data da Venda</label>
                <input class="medio" type="date" name="datavenda" required>
                </div>
                <h2>Preço</h2>
                <div class="espacamento">
                <label for="precoproduto">Preço</label>
                <input class="medio" type="text" id="precoproduto" readonly>

                <label for="qtvproduto">Quantidade</label>
                <input class="pequenininho tirarseta" type="number" name="qtvproduto" id="qtvproduto" min="1" onchange="atualizarPreco()" required>

                <label for="descontoproduto">Desconto (%)</label>
                <input class="medio tirarseta" type="number" name="descontoproduto" id="descontoproduto" min="0" max="100" onchange="atualizarPreco()">
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
<script>
function mostrarPreco() {
    const selectProduto = document.getElementById("idproduto");
    const preco = selectProduto.options[selectProduto.selectedIndex].getAttribute("data-preco");
    document.getElementById("precoproduto").value = preco ? "R$ " + parseFloat(preco).toFixed(2) : "";
    atualizarPreco(); // Atualiza o preço total quando o produto é selecionado
}

function atualizarPreco() {
    const preco = parseFloat(document.getElementById("idproduto").options[document.getElementById("idproduto").selectedIndex].getAttribute("data-preco")) || 0;
    const quantidade = parseInt(document.getElementById("qtvproduto").value) || 1;
    const desconto = parseFloat(document.getElementById("descontoproduto").value) || 0;

    let precoTotal = preco * quantidade;
    if (desconto > 0 && desconto <= 100) {
        precoTotal -= (precoTotal * (desconto / 100));
    }

    document.getElementById("precoproduto").value = "R$ " + precoTotal.toFixed(2);
}
</script>
</body>
</html>