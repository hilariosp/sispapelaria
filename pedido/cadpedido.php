<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pedido.css">
    <title>Document</title>
</head>
<body>

<header>
        <h1><a href="../index.php">SisPapelaria</a></h1>
        
</header>

    <div class="conteudo">
        <article>

            <h1>Cadastro de pedidos</h1>
            
            <form action="caddisc.php" method="get">
                
                <div class="form">

                    <h2>Dados do Pedido</h2>

                    <label for="nome">Nome do Cliente</label>
                    <input class="total" type="text" name="nome" required>
                    <div class="espacamento">
                    <label for="id">ID do Produto</label>
                    <input class="fino" type="text" name="id" required>
                    <label for="id">Código do Pedido</label>
                    <input class="fino" type="text" name="cod" required>
                    <label for="marca">Marca</label>
                    <select name="marca" class="fino">
                        <option value=""></option>
                    </select>
                    </div>
                    <div class="espacamento">
                    <label for="tipo">Tipo do Produto</label>
                    <select name="tipo" class="fino">
                        <option value=""></option>
                        
                    </select>
                    <label for="qt">Quantidade</label>
                    <input class="fino" type="number" name="qt" required>
                    <label for="dtpedido">Data do Pedido</label>
                    <input class="fino" type="date" name="cod" required>
                    </div>
                    <label for="preco">Preço (em R$)</label>
                    <input class="fino" type="number" name="preco" required>
                    </div>
                        <button>Cadastrar</button>
                        <a href="index.php">Ou clique aqui para ver apenas a listagem de disciplinas</a>
                </div>
            </form>
        </article>
    </div>

    <footer>
    </footer>
</body>
</html>