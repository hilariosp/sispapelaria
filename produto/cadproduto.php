<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produtos.css">
    <title>Document</title>
</head>
<body>

<header>
        <h1><a href="../index.php">SisPapelaria</a></h1>
</header>
    <div class="conteudo">
        <article>
        <form action="index.php" method="get">

<h1>Cadastro de produtos</h1>

<div class="form">

    <h2>Dados do Produto</h2>

    <label for="nome">Nome do Produto</label>
    <input type="text" class="total" name="nome" required>
    <div class="espacamento">
        <label for="id">ID</label>
        <input type="number" class="medio" name="id" required>
        <label for="marca">Marca</label>
        <select name="categoria" class="medio" name="marca" required>
            <option value=""></option>
            <option value="caderno">Caderno</option>
            <option value="livro">Livro</option>
            <option value="lapis">Lápis</option>
            <option value="caneta">Caneta</option>
            <option value="marcatexto">Marca-Texto</option>
            <option value="borracha">Borracha</option>
        </select>
        <label for="categoria">Categoria</label>
        <select name="categoria" class="medio" name="categoria" required>
            <option value=""></option>
            <option value="caderno">Caderno</option>
            <option value="livro">Livro</option>
            <option value="lapis">Lápis</option>
            <option value="caneta">Caneta</option>
            <option value="marcatexto">Marca-Texto</option>
            <option value="borracha">Borracha</option>
        </select>
    </div>
    <div class="espacamento">
    <label for="preco">Preço</label>
    <input type="number" class="medio" name="preco" required>
    <label for="qtestoque">Quantidade em estoque</label>
    <input type="number" class="fino" name="qtestoque" required>
    </div>
    <button>Cadastrar</button>
    <a href="index.php">Clique aqui para conferir a listagem de produtos</a>
                </div>
            </form>
        </article>
    </div>

    <footer>
    </footer>
</body>
</html>
