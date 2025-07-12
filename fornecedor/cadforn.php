<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesforn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Cadastro de Clientes</title>
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
                    <form action="crud.php" method="post">
                        <h2>Dados pessoais</h2>
                        <label for="nomefornecedor"><p>Nome do Fornecedor</p></label>
                        <div class="espacamento">
                        <input class="total" type="text" name="nomefornecedor" required>
                        </div>

                        <label for="enderecofornecedor"><p>Endereço</p></label>
                        <div class="espacamento">
                        <input class="total" type="text" name="enderecofornecedor" required>
                        </div>
                        
                        <div class="espacamento">

                        <label for="emailfornecedor"><p>E-mail</p></label>
                        <input class="medio" type="email" name="emailfornecedor" required>
                        
                        <label for="telefonefornecedor"><p>Telefone</p></label>
                        <input class="fino tirarseta" type="number" name="telefonefornecedor" required>


                        <label for="cnpjfornecedor"><p>CNPJ</p></label>
                        <input class="fino tirarseta" type="number" name="cnpjfornecedor" required>

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