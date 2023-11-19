<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>Pousadas On Line</title>
</head>
<?php
require_once 'includes/banco.php';
require_once 'includes/funcoes.php';
require_once 'includes/login.php';
?>
<body>
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

<main>

    <?php
        $c=$_GET["cod"]??0;
        $busca=$banco->query("select * from pousada where id='$c'");
    ?>

    <table class="detalhes">
        <?php
        if (!$busca)
            echo "<tr><td>Busca falhou! $banco->error</tr></td>";
        else{
            if ($busca->num_rows==1){
                $reg=$busca->fetch_object();
                // Não colocar a função thumb() direto na tag img, nao vai funcionar.
                $t=thumb($reg->foto);
                echo "<tr><td rowspan='3'><img src='$t' class='full2'/></td></tr>";
                echo "<td><h2>$reg->nome</h2>";
                echo "Nota: ".number_format($reg->nota,1)."/10.0";
                if (isAdmin()){
                    echo "  <span class='material-symbols-outlined'>add</span> ";
                    echo "<span class='material-symbols-outlined'>edit</span> ";
                    echo "<span class='material-symbols-outlined'>delete</span>";
                }
                else if (isEditor())
                    echo "  <span class='material-symbols-outlined'>edit</span>";
                echo "<tr><td style='text-align: justify;'>$reg->descricao</td></tr>";
                echo "<tr><td>Adm</td></tr>";
            }
            else{
                echo "<tr><td>Nenhum registro encontrado</tr></td>";
            }
        }
        ?>
    </table>

</main>

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