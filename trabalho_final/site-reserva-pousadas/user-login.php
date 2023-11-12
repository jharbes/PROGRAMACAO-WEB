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
                <li><input type="text" name="busca" id="busca" placeholder="Busque aqui sua pousada..."></li>
                <li><a href="listagem-pousadas.php">Listagem de Pousadas</a></li>
                <li><a href="#">Informações de Destinos</a></li>
                <li><a href="#">Suporte ao Cliente</a></li>
                <li><a href="user-login.php">Login/Registro</a></li>
            </ul>
        </nav>
    </header>

  <main>

<div id="corpo">
    <?php
        $u=$_POST['usuario']??null;
        $s=$_POST['senha']??null;

        if (is_null($u) || is_null($s))
            require 'user-login-form.php';
        else{
            $q="SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
            $busca=$banco->query($q);
            if (!$busca){
                echo msgErro('Falha ao acessar o banco!');
            }
            else{
                if ($busca->num_rows>0){
                    $reg=$busca->fetch_object();
                    if (testarHash($s,$reg->senha)){
                        echo msgSucesso("Logado com sucesso!");
                        $_SESSION['user']=$reg->usuario;
                        $_SESSION['nome']=$reg->nome;
                        $_SESSION['tipo']=$reg->tipo;
                    }
                    else
                        echo msgErro("Senha Inválida!");
                }else
                    echo msgErro("Usuário não encontrado!");
            }
        }
        echo voltar();
    ?>
</div>

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