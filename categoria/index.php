<?php 
  require_once('../conexao.php');

  $retorno = $conexao->prepare('SELECT * FROM categoria ORDER BY idcategoria DESC');
  $retorno->execute();
?>  


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescategoria.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Lista de Categorias</title>
    <script>
        function confirmarAcao(mensagem) {
            // Exibe a mensagem de confirmação e captura a resposta do usuário
            return confirm(mensagem);
        }
    </script>
</head>
<body>
    <header>
        <h1><a href="../">PaperSuite</a></h1>
    </header>
    <article class="article-index">
    <h1>Lista de Categorias</h1>
        <nav>
            <a href=".."><button class="botaolink"><i class="fas fa-house"></i>Página Inicial</button></a>
        </nav>
        <div class="container">
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome da Categoria</th>
                            <th class="botoes-tabela"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($retorno->fetchall() as $value) { ?>
                        <tr>
                        <td><?php echo $value['idcategoria']?></td>
                        <td><?php echo $value['nomecategoria']?></td>
                        <td>
                        <div class="espacamento">
                    <form method="GET" action="editcategoria.php" onsubmit="return confirmarAcao('Tem certeza que deseja editar a categoria?')">
                        <input name="idcategoria" type="hidden" value="<?php echo $value['idcategoria'];?>"/>
                        <button name="editar" class="botaotabela editar" type="submit"><i class="fas fa-edit"></i>Editar</button>
                    </form>
                    <form method="POST" action="crudcategoria.php" onsubmit="return confirmarAcao('Tem certeza que deseja excluir a categoria?')">
                        <input name="idcategoria" type="hidden" value="<?php echo $value['idcategoria'];?>"/>
                        <button name="excluir" class="botaotabela excluir" type="submit"><i class="fas fa-trash-alt"></i>Excluir</button>
                    </form>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <nav class="nav-direita">
                    <a href="cadcategoria.php"><button class="botaolink"><i class="fas fa-plus"></i>Cadastrar</button></nav>
                </nav>
    </article>
</body>
</html>
