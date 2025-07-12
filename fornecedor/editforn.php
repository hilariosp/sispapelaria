<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesforn.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Editar Fornecedores</title>
</head>
<body>
<?php
  //incluir arquivo de conexao com o BD
    require_once('../conexao.php');
 
    //armazena id 
    if (isset($_GET['idfornecedor'])) {
        $idfornecedor = $_GET['idfornecedor'];
    } else {
        die("ID do fornecedor não definido.");
    }

    $sql = "SELECT * FROM fornecedor WHERE idfornecedor = :idfornecedor";
   
    // Junta o SQL à conexão do banco
    $retorno = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetro
    $retorno->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);

    // Executa a estrutura no banco
    $retorno->execute();

    // Transforma o retorno em array
    $array_retorno = $retorno->fetch();
   
    // Armazena retorno em variáveis e evita erro caso a chave não exista
    $nomefornecedor = $array_retorno['nomefornecedor'] ?? '';
    $enderecofornecedor = $array_retorno['enderecofornecedor'] ?? '';
    $telefonefornecedor = $array_retorno['telefonefornecedor'] ?? '';
    $emailfornecedor = $array_retorno['emailfornecedor'] ?? '';
    $cnpjfornecedor = $array_retorno['cnpjfornecedor'] ?? '';

 
?>
<header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Editar Fornecedores</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudforn.php" method="post">
                        <h2>Dados pessoais</h2>
                        <input type="hidden" name="idfornecedor" value="<?php echo $idfornecedor; ?>">
                        <label for="nomefornecedor">Nome do Fornecedor</label>
                        <input class="total" type="text" name="nomefornecedor" required value="<?php echo($nomefornecedor); ?>">
                        <label for="enderecofornecedor">Endereço</label>
                        <input class="total" type="text" name="enderecofornecedor" required value="<?php echo($enderecofornecedor); ?>">
                        <div class="espacamento">
                        <label for="emailfornecedor">E-mail</label>
                        <input class="medio" type="email" name="emailfornecedor" required value="<?php echo($emailfornecedor); ?>">
                        <label for="telefonefornecedor">Telefone</label>
                        <input class="fino tirarseta" type="number" name="telefonefornecedor" required value="<?php echo($telefonefornecedor); ?>">
                        <label for="cnpjfornecedor">CNPJ</label>
                        <input class="fino tirarseta" type="number" name="cnpjfornecedor" required value="<?php echo($cnpjfornecedor); ?>">
                </div>

                <button name="editar" class="botaoform">Editar</button>
                    </form>
                    <nav class="nav-direita">
                        <a href="index.php"><button class="botaolink"><i class="fas fa-table"></i>Voltar para lista</button>
                    </nav>
                </div>
            </div>
        </article>
    </div>
</body>
</html>