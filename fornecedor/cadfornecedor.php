<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forne.css">
    <title>Document</title>
</head>
<body>

<header>
        <h1><a href="../index.php">SisPapelaria</a></h1>
</header>
    <div class="conteudo">
        <article>
        <form action="../pedido/cadpedido.php" method="get">

<h1>Cadastro de fornecedor</h1>

<div class="form">

    <h2>Dados do Fornecedor</h2>

    <label for="nome">Nome do Fornecedor</label>
    <input type="text" class="total" name="nomefornecedor" required>
    <div class="espacamento">
        <label for="id">ID do fornecedor</label>
        <input type="number" class="medio" name="id" required>
        <label for="marca">Nome da Marca</label>
        <input type="text" class="medio" name="marca" required>
    </div>
    <button>Cadastrar</button>
    <a href="index.php">Clique aqui para conferir a listagem de fornecedores</a>
                </div>
            </form>
        </article>
    </div>

    <footer>
    </footer>
</body>
</html>
