<?php 

require_once('../conexao.php');

// Consulta SQL para buscar os produtos junto com os nomes da marca e da categoria
$sql = 'SELECT c.idcompra, f.nomefornecedor, p.nomeproduto, c.datacompra, c.qtcproduto
        FROM compra c 
        JOIN fornecedor f ON c.idfornecedor = f.idfornecedor 
        JOIN produto p ON c.idproduto = p.idproduto
        ORDER BY c.idcompra DESC';

$retorno = $conexao->prepare($sql);
$retorno->execute();

?>  



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescompra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Lista de Compras</title>
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
    <h1>Lista de Compras</h1>
        <nav>
            <a href=".."><button class="botaolink"><i class="fas fa-house"></i>Página Inicial</button></a>
        </nav>
        <div class="container">
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                        <th>Nome do Fornecedor</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Data da Compra</th>
                        <th class="botoes-tabela"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($retorno->fetchall() as $value) { 
                
                            $dataCompra = new DateTime($value['datacompra']);
                            $data = $dataCompra->format('d/m/Y');

                        ?>
                    <tr>
                        <td><?php echo $value['nomefornecedor']?></td>
                        <td><?php echo $value['nomeproduto']?></td>
                        <td><?php echo $value['qtcproduto']?></td>
                        <td><?php echo $data; ?></td>
                        <td>
                            <div class="espacamento"> 
                                <form method="GET" action="editcompra.php" onsubmit="return confirmarAcao('Tem certeza que deseja editar a compra?')">
                                    <input name="idcompra" type="hidden" value="<?php echo $value['idcompra'];?>"/>
                                    <button name="editar" class="botaotabela editar" type="submit"><i class="fas fa-edit"></i>Editar</button>
                                </form>
                                <form method="POST" action="crudcompra.php" onsubmit="return confirmarAcao('Tem certeza que deseja excluir a compra')">
                                    <input name="idcompra" type="hidden" value="<?php echo $value['idcompra'];?>"/>
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
                    <a href="cadcompra.php"><button class="botaolink"><i class="fas fa-plus"></i>Cadastrar</button></nav>
        </nav>
    </article>
</body>
</html>
