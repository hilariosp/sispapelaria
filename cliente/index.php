<?php 
  require_once('../conexao.php');

  $retorno = $conexao->prepare('SELECT * FROM cliente ORDER BY idcliente DESC');
  $retorno->execute();
?>  


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="stylescliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PaperSuite | Lista de Clientes</title>
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
    <h1>Lista de Clientes</h1>
        <nav>
            <a href=".."><button class="botaolink"><i class="fas fa-house"></i>Página Inicial</button></a>
        </nav>
        <div class="container">
            <div class="tabela-container">
                <table class="tabela">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th class="botoes-tabela"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($retorno->fetchall() as $value) { 
                        
                        $nasccliente = new DateTime($value['nasccliente']);
                        $data = $nasccliente->format('d/m/Y');
                        
                        ?>
                        <tr>
                        <td><?php echo $value['nomecliente']?></td>
                        <td><?php echo $value['enderecocliente']?></td>
                        <td><?php echo $value['emailcliente']?></td>
                        <td><?php echo $value['telefonecliente']?></td>
                        <td>
                        <div class="espacamento">
                    <form method="GET" action="editcliente.php" onsubmit="return confirmarAcao('Tem certeza que deseja editar o cliente?')">
                        <input name="idcliente" type="hidden" value="<?php echo $value['idcliente'];?>"/>
                        <button name="editar" class="botaotabela editar" type="submit"><i class="fas fa-edit"></i>Editar</button>
                    </form>
                    <form method="POST" action="crudcliente.php" onsubmit="return confirmarAcao('Tem certeza que deseja excluir o cliente?')">
                        <input name="idcliente" type="hidden" value="<?php echo $value['idcliente'];?>"/>
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
                    <a href="cadcliente.php"><button class="botaolink"><i class="fas fa-plus"></i>Cadastrar</button></nav>
                </nav>
    </article>
</body>
</html>
