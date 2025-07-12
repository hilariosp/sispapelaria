<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesmarca.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Editar Marcas</title>
</head>
<body>
<?php
  //incluir arquivo de conexao com o BD
    require_once('../conexao.php');

    //armazena id 
    if (isset($_GET['idmarca'])) {
        $idmarca = $_GET['idmarca'];
    } else {
        die("ID da marca não definido.");
    }

    // SQL para selecionar uma marca
    $sql = "SELECT * FROM marca WHERE idmarca = :idmarca";
   
    // Junta o SQL à conexão do banco
    $retorno = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetro
    $retorno->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);

    // Executa a estrutura no banco
    $retorno->execute();

    // Transforma o retorno em array
    $array_retorno = $retorno->fetch();
   
    // Armazena retorno em variáveis
    $nomemarca = $array_retorno['nomemarca'] ?? ''; // Evita erro caso a chave não exista
 
?>
<header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Editar Marcas</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudmarca.php" method="post">
                        <h2>Dados pessoais</h2>
                        <input type="hidden" name="idmarca" value="<?php echo $idmarca; ?>">
                        <label for="nomemarca"><p>Nome da Marca</p></label>
                        <div class="espacamento">
                        <input class="total" type="text" name="nomemarca" required value="<?php echo($nomemarca); ?>">
                        </div>
                        <button name="editar" class="botaoform">Editar</button>
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
