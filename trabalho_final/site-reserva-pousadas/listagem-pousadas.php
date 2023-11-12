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
        <h1>Pousadas On Line</h1>

        <nav aria-label="primaria">
            <ul class="menu">
                <li><input type="text" name="busca" id="busca" placeholder="Busque aqui sua pousada..."></li>
                <li><a href="#">Listagem de Pousadas</a></li>
                <li><a href="#">Informações de Destinos</a></li>
                <li><a href="#">Suporte ao Cliente</a></li>
                <li><a href="user-login.php">Login/Registro</a></li>
            </ul>
        </nav>
    </header>

<main>
<table class="listagem">
        <?php
        /*
            $q="select * from jogos j join generos g on j.genero=g.cod";
        */
            $q="select * from pousada;";

            if (!empty($chave)){
                $q.="where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
            }

            // switch ($ordem){
            //     case "p":
            //         $q.="order by p.produtora";
            //         break;
            //     case "n1":
            //         $q.="order by j.nota desc";
            //         break;
            //     case "n2":
            //         $q.="order by j.nota asc";
            //         break;
            //     default:
            //         $q.="order by j.nome";
            // }
            $busca=$banco->query($q);
            if (!$busca)
                echo "<tr><td>Infelizmente a busca deu erro!</tr></td>";
            else{
                if ($busca->num_rows==0)
                    echo "<tr><td>Nenhum registro encontrado!</tr></td>";
                else{
                    while($reg=$busca->fetch_object()){
                        $t=thumb($reg->foto);
                        echo "<tr><td><img src='$t' class='mini2'/>";
                        echo "<td><a href='#?cod=$reg->id'>$reg->nome</a>";
                        echo "<br>$reg->localizacao";
                        echo "<br>$reg->descricao";
                        if (isAdmin()){
                            echo "<td>";
                            echo "<span class='material-symbols-outlined'>add</span> ";
                            echo "<span class='material-symbols-outlined'>edit</span> ";
                            echo "<span class='material-symbols-outlined'>delete</span>";
                        }
                        else if (isEditor())
                            echo "<td><span class='material-symbols-outlined'>edit</span>";
                    }
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