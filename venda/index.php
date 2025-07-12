<?php 
  require_once('../conexao.php');

    $sql = 'SELECT v.idvenda, c.nomecliente, p.nomeproduto, v.datavenda, p.precoproduto, v.qtvproduto, v.descontoproduto, v.precovenda
        FROM venda v 
        JOIN cliente c ON v.idcliente = c.idcliente 
        JOIN produto p ON v.idproduto = p.idproduto
        ORDER BY v.idvenda DESC';

    $retorno = $conexao->prepare($sql);
    $retorno->execute();

?>  


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylesvenda.css">
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
    <h1>Lista de Vendas</h1>
        <nav>
            <a href=".."><button class="botaolink"><i class="fas fa-house"></i>Página Inicial</button></a>
        </nav>
        <div class="container">
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Nome do Produto</th>
                            <th>Data da venda</th>
                            <th>Preço do produto</th>
                            <th>Quantidade vendida</th>
                            <th>Desconto</th>
                            <th>Preço da venda</th>
                            <th class="botoes-tabela"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($retorno->fetchall() as $value) {

                        $datavenda = new DateTime($value['datavenda']);
                        $data = $datavenda->format('d/m/Y');

                        ?>
                        <tr>
                            <td><?php echo $value['nomecliente']?></td>
                            <td><?php echo $value['nomeproduto']?></td>
                            <td><?php echo $data; ?></td>
                            <td><?php echo "R$ " . $value['precoproduto']?></td>
                            <td><?php echo $value['qtvproduto']?></td>
                            <td><?php echo $value['descontoproduto']?></td>
                            <td><?php echo "R$ " . $value['precovenda']?></td>
                            <td>
                                <div class="espacamento">
                                <form method="GET" action="editvenda.php" onsubmit="return confirmarAcao('Tem certeza que deseja editar a venda?')">
                                <input name="idvenda" type="hidden" value="<?php echo $value['idvenda'];?>"/>
                                <button name="editar" class="botaotabela editar" type="submit"><i class="fas fa-edit"></i>Editar</button>
                                </form>
                                <form method="POST" action="crudvenda.php" onsubmit="return confirmarAcao('Tem certeza que deseja excluir a venda?')">
                                <input name="idvenda" type="hidden" value="<?php echo $value['idvenda'];?>"/>
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
                    <a href="cadvenda.php"><button class="botaolink"><i class="fas fa-plus"></i>Cadastrar</button></nav>
                </nav>
    </article>
</body>
</html>
