<?php 

require_once('../conexao.php');

// Consulta SQL para buscar os produtos junto com os nomes da marca e da categoria
$sql = 'SELECT p.idproduto, p.nomeproduto, m.nomemarca, c.nomecategoria, p.precoproduto, p.qtproduto 
        FROM produto p 
        JOIN marca m ON p.marcaproduto = m.idmarca 
        JOIN categoria c ON p.categoriaproduto = c.idcategoria 
        ORDER BY p.idproduto DESC';

$retorno = $conexao->prepare($sql);
$retorno->execute();

?>  

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesprod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Lista de Produtos</title>
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
    <h1>Lista de Produtos</h1>
        <nav>
            <a href=".."><button class="botaolink"><i class="fas fa-house"></i>Página Inicial</button></a>
        </nav>
        <div class="container">
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                        <th>ID do Produto</th>
                        <th>Nome do Produto</th>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th class="botoes-tabela"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($retorno->fetchall() as $value) { 

                        ?>
                    <tr>
                        <td><?php echo $value['idproduto']; ?></td>
                        <td><?php echo $value['nomeproduto']; ?></td>
                        <td><?php echo $value['nomemarca']; ?></td>
                        <td><?php echo $value['nomecategoria']; ?></td>
                        <td><?php echo $value['precoproduto']; ?></td>
                        <td><?php echo $value['qtproduto']; ?></td>
                        <td>
                            <div class="espacamento"> 
                                <form method="GET" action="editprod.php" onsubmit="return confirmarAcao('Tem certeza que deseja editar o produto?')">
                                    <input name="idproduto" type="hidden" value="<?php echo $value['idproduto'];?>"/>
                                    <button name="editar" class="botaotabela editar" type="submit"><i class="fas fa-edit"></i>Editar</button>
                                </form>
                                <form method="POST" action="crudprod.php" onsubmit="return confirmarAcao('Tem certeza que deseja excluir o produto?')">
                                    <input name="idproduto" type="hidden" value="<?php echo $value['idproduto'];?>"/>
                                    <button name="excluir" class="botaotabela excluir" type="submit"><i class="fas fa-trash-alt"></i>Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
        <nav class="nav-direita">
                    <a href="cadprod.php"><button class="botaolink"><i class="fas fa-plus"></i>Cadastrar</button></nav>
        </nav>
    </article>
</body>
</html>
