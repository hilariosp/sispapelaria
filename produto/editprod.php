<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesprod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Editar Compras</title>
</head>
<body>
<?php
  //incluir arquivo de conexao com o BD
    require_once('../conexao.php');
 
    //armazena id 
    if (isset($_GET['idproduto'])) {
        $idproduto = $_GET['idproduto'];
    } else {
        die("ID do produto não definido.");
    }

    $sql = "SELECT * FROM produto WHERE idproduto = :idproduto";
   
    // Junta o SQL à conexão do banco
    $retorno = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetro
    $retorno->bindParam(':idproduto', $idproduto, PDO::PARAM_INT);

    // Executa a estrutura no banco
    $retorno->execute();

    // Transforma o retorno em array
    $array_retorno = $retorno->fetch();
   
    // Armazena retorno em variáveis
    $nomeproduto = $array_retorno['nomeproduto'] ?? ''; // Evita erro caso a chave não exista
    $marcaproduto  = $array_retorno['marcaproduto'] ?? '';
    $categoriaproduto = $array_retorno['categoriaproduto'] ?? '';
    $precoproduto = $array_retorno['precoproduto'] ?? '';
    $qtproduto = $array_retorno['qtproduto'] ?? '';
 
?>
<header>
    <h1><a href="../index.php">PaperSuite</a></h1>
    </header>
    <article>
        <h1>Editar Produtos</h1>
            <div class="container">
                <div class="form-container">
                    <nav>
                        <a href=".."><button class="botaolink"><i class="fas fa-house"> </i>Página Inicial</button></a>
                    </nav>
                    <form action="crudprod.php" method="post">
                        <h2>Dados pessoais</h2>
                       
                    <input type="hidden" name="idproduto" value="<?php echo $idproduto; ?>">

                    <label for="nomeproduto"><p>Nome do Produto</p></label>
                    <input type="text" class="total" name="nomeproduto" required value="<?php echo($nomeproduto); ?>">

                    <div class="espacamento">

                    <label for="marcaproduto"><p>Marca</p></label>
                    <select name="marcaproduto" class="medio" required>
                    <option value=""></option>
                        <?php
                        include 'conexao.php';
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
                        include 'conexao.php';
                        $retorno = $conexao->prepare('SELECT idcategoria, nomecategoria FROM categoria');
                        $retorno->execute();

                        foreach($retorno->fetchall() as $value) { ?>
                            <option value="<?php echo($value['idcategoria'])?>"><?php echo($value['nomecategoria'])?></option>
                            
                        <?php } ?>
                    </select>

                    <label for="precoproduto"><p>Preço</p></label>
                    <input type="number" step="0.01" class="fino tirarseta" name="precoproduto" value="<?php echo($precoproduto); ?>" required>
                    
                    <label for="qtproduto"><p>Estoque</p></label>
                    <input type="number" class="fino tirarseta" name="qtproduto" min="1" value="<?php echo($qtproduto); ?>" required>
                    </div>
                <button class="botaoform" name="editar">Editar</button>
            </div>

