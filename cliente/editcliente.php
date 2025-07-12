<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Editar Clientes</title>
</head>
<body>
<?php
  //incluir arquivo de conexao com o BD
    require_once('../conexao.php');
 
    //armazena id 
    if (isset($_GET['idcliente'])) {
        $idcliente = $_GET['idcliente'];
    } else {
        die("ID do cliente não definido.");
    }

    $sql = "SELECT * FROM cliente WHERE idcliente = :idcliente";
   
    // Junta o SQL à conexão do banco
    $retorno = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetro
    $retorno->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);

    // Executa a estrutura no banco
    $retorno->execute();

    // Transforma o retorno em array
    $array_retorno = $retorno->fetch();
   
    // Armazena retorno em variáveis e evita erro caso a chave não exista
    $nomecliente = $array_retorno['nomecliente'] ?? '';
    $enderecocliente = $array_retorno['enderecocliente'] ?? '';
    $emailcliente = $array_retorno['emailcliente'] ?? '';
    $cpfcliente = $array_retorno['cpfcliente'] ?? '';
    $nasccliente = $array_retorno['nasccliente'] ?? '';
    $telefonecliente = $array_retorno['telefonecliente'] ?? '';
    $generocliente = $array_retorno['generocliente'] ?? '';
 
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
                    <form action="crudcliente.php" method="post">
                        <h2>Dados pessoais</h2>
                        <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                        <label for="nomecliente"><p>Nome do cliente</p></label>
                        <div class="espacamento">
                        <input class="total" type="text" name="nomecliente" required value="<?php echo($nomecliente); ?>">
                        </div>
                        <label for="enderecocliente"><p>Endereço</p></label>
                        <div class="espacamento">
                        <input class="total" type="text" name="enderecocliente" required value="<?php echo($enderecocliente); ?>">
                        </div>
                        <div class="espacamento">
                        <label for="emailcliente"><p>E-mail</p></label>
                        <input class="medio" type="email" name="emailcliente" required value="<?php echo($emailcliente); ?>">
                        <label for="telefonecliente"><p>Telefone</p></label>
                        <input class="fino tirarseta" type="number" name="telefonecliente" required value="<?php echo($telefonecliente); ?>">
                        </div>
                        <button class="botaoform" name="editar">Editar</button>
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