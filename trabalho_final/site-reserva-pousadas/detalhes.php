<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
    <title>Pousadas On Line</title>
    <style>
        img{
            max-width: 600px;
        }
    </style>
</head>
<?php
require_once 'includes/banco.php';
require_once 'includes/funcoes.php';
require_once 'includes/login.php';
$user_email=$_SESSION['user'];
?>
<body>
<?php include 'topo.php';?>
    <header class="header">
        <h1><a href="index.php">Pousadas On Line</a></h1>

        <nav aria-label="primaria">
            <ul class="menu">
            <form action="listagem-pousadas.php" method="get">
                    <li class="search-bar"><input type="text" name="c" id="ibusca" placeholder="Busque aqui sua pousada..." size="10" maxlength="40"></li>
                    <li>
                    <input id="botaook" type="submit" value="OK" width='50'></li>
                </form>
                <li><a href="listagem-pousadas.php">Listagem de Pousadas</a></li>
                <li><a href="#">Informações de Destinos</a></li>
                <li><a href="#">Suporte ao Cliente</a></li>
                <li><a href="user-login.php">Login/Registro</a></li>
            </ul>
        </nav>
    </header>

<main class="container">

    <?php
        $c=$_GET["cod"]??0;
        $busca=$banco->query("select pousada.*, avg(avaliacao.nota) as media from pousada left join avaliacao on pousada.id=avaliacao.fk_idpousada where pousada.id='$c'");
        $avaliacoes=$banco->query("SELECT avaliacao.*, usuario.id,usuario.nome
        FROM avaliacao 
        JOIN usuario ON avaliacao.fk_idusuario = usuario.id 
        WHERE fk_idpousada = '$c';")
    ?>

    
        <?php
        if (!$busca)
            echo msgErro("Busca falhou! $banco->error");
        else{
            if ($busca->num_rows==1){
                echo '<table class="detalhes">';
                $reg=$busca->fetch_object();
                // Não colocar a função thumb() direto na tag img, nao vai funcionar.
                $t=thumb($reg->foto);
                echo "<tr><td rowspan='3'><img src='$t' class='full2'/></td></tr>";
                echo "<td><h2><strong>$reg->nome</strong></h2>";
                echo $reg->localizacao."<br>";
                echo "Nota: ".number_format($reg->media,1)."/5.0";
                if (isAdmin()){
                    echo "  <span class='material-symbols-outlined'>add</span> ";
                    echo "<span class='material-symbols-outlined'>edit</span> ";
                    echo "<span class='material-symbols-outlined'>delete</span>";
                }
                
                else if (isCliente())
                    echo "  <span class='material-symbols-outlined'></span>";
                echo "<tr><td style='text-align: justify;'>$reg->descricao</td></tr>";
                echo "</table><br>";
            }
            else{
                echo msgAviso("Nenhum registro encontrado");
            }
        }

        




        // Mostrando a lista de quartos disponiveis

        $idPousada=$c;

        $consulta = $banco->prepare("SELECT id, numero, tipo, disponibilidade, preco_noite FROM quarto WHERE fk_idpousada = ? ORDER BY preco_noite");
        if (!$consulta) {
            echo msgErro("Erro ao preparar consulta: " . $banco->error);
            exit;
        }

        $consulta->bind_param("i", $idPousada);
        $consulta->execute();

        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            echo "<table class='reserva'>";
            echo "<tr><th>Número do Quarto</th><th>Disponibilidade</th><th>Preço por Noite</th><th>Tipo</th><th>Reserva</th></tr>";
            while ($quarto = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $quarto['numero'] . "</td>";
                echo "<td>" . ($quarto['disponibilidade'] ? 'Disponível' : 'Indisponível') . "</td>";
                echo "<td>R$ " . number_format($quarto['preco_noite'], 2, ',', '.') . "</td>";
                echo "<td>" . $quarto['tipo'] . "</td>";
                // Verificação para a coluna Reserva
                if ($quarto['disponibilidade']) {
                    echo "<td><a href='efetuar-reserva.php?id=" . $quarto['numero'] . "'>Reservar</a></td>";
                } else {
                    echo "<td>Indisponível</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo msgAviso("Nenhum quarto disponível.");
            }
        



        

        // Mostrando a lista de avaliações

        echo "<h2 id='h2_avaliacoes'>Avaliações da Pousada: </h2><br>";
        
        
            if (!$avaliacoes)
                echo msgErro("Busca por avaliações falhou!". $banco->error);
            else{
                if ($avaliacoes->num_rows>=1){
                    echo "<ul class='avaliacoes table'>";
                    while($reg=$avaliacoes->fetch_object()){
                        echo "<li>Nome do Avaliador: " . htmlspecialchars($reg->nome);
                        echo "<br>Comentário: " . htmlspecialchars($reg->comentario);
                        echo "<br>Nota: " . htmlspecialchars($reg->nota)."</li>";
                        
                    }
                    echo "</ul>";
                } else{
                    echo msgAviso("Nenhuma avaliação encontrada.");
                }

            }
        ?>
    
    </main>
    
    <!-- Incluindo avaliações SE o usuario estiver logado -->

    <?php
    // Verifica se o usuário está logado
    if (!empty($_SESSION['user'])) {
        echo "<br>";
        echo "<h2>Incluir nova Avaliação:</h2>";
        // Supondo que você tenha o ID da pousada de alguma forma (talvez passado via GET)
        $busca_id=$banco->query("select * from usuario where email='$user_email';");
        $reg2=$busca_id->fetch_object();
        $usuarioLogadoId=$reg2->id;
        $pousadaId = $c;
        
        echo '<form class="inclui_comentario" style="text-align: center;" action="processa_comentario.php" method="post">';
            echo '<input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuarioLogadoId); ?>">';
            echo '<input type="hidden" name="pousada_id" value="';?><?php echo htmlspecialchars($pousadaId); ?><?php echo '">
            <label for="nota">Nota:</label>
            <input type="number" name="nota" id="nota" step="0.1" min="0" max="5">
            <br><br>
            <label for="comentario">Comentário:</label><br>
            <textarea name="comentario" id="comentario"></textarea>
            <button type="submit">Enviar Comentário</button>
        </form>';
    
    } else {
        echo msgAviso("<strong>Usuário deve estar logado para fazer avaliações.</strong>");
    }
?>



<footer class="rodape">
  <p>Pousadas On Line. Alguns Direitos Reservados.</p>
</footer>
</body>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script> -->
  

</html>