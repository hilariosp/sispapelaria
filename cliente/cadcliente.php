<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cliente.css">
    <title>Document</title>
</head>
<body>

<header>
        <h1><a href="../index.php">SisPapelaria</a></h1>

</header>

    <div class="conteudo">
        <article>

            <h1>Cadastro de clientes</h1>
            
            <form action="index.php" method="get">
                
                <div class="form">

                    <h2>Dados pessoais</h2>

                    <label for="nome">Nome Completo</label>
                    <input class="total" type="text" name="nome" required>

                    <label for="endereco">Endereço</label>
                    <input class="total" type="text" name="endereco" required>

                    <div class="espacamento">
                    <label for="email">E-mail</label>
                    <input class="largo" type="text" name="email" required>

                    <label for="nasc">Data de nascimento</label>
                    <input class="fino" type="date" name="nasc" required>
                    </div>

                    <div class="espacamento">

                        <label for="CPF">CPF</label>
                        <input class="fino" type="number" name="CPF" required>

                        <label for="genero">Gênero</label>
                        <select class="fino" name="genero" required>
                            <option value=""></option>
                            <option value="masc">Homem</option>
                            <option value="fem">Mulher</option>
                        </select>

                    </div>

                    <button>Cadastrar</button>
                    <a href="index.php">Clique aqui para ver apenas a listagem de clientes</a>
                </div>
            </form>
        </article>
    </div>

    <footer>
    </footer>
</body>
</html>