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

<main>

<div id="corpo">
<?php
    if (!isLogado())
        echo msgErro("Efetue o <strong><a href='user-login.php'>login</a></strong> para poder editar seus dados.");
    else{
        if (!isset($_POST['usuario']))
            include 'user-edit-form.php';
        else{
            $usuario=$_POST['usuario']??null;
            $nome=$_POST['nome']??null;
            $tipo=$_POST['tipo']??null;
            $senha1=$_POST['senha1']??null;
            $senha2=$_POST['senha2']??null;

            $q="UPDATE usuario SET email='$usuario', nome='$nome'";

            if (empty($senha1) || is_null($senha1))
                echo msgAviso("Senha antiga foi mantida!");
            else if ($senha1===$senha2){
                // $senha=gerarHash($senha1);
                $q.=", senha='$senha'";
            }
            else
                echo msgErro("Senhas não conferem, a senha anterior será mantida.");
            
            $q.=" where email='".$_SESSION['user']."'";

            if ($banco->query($q)){
                echo msgSucesso("Usuário alterado com sucesso!");
                logout();
                echo msgAviso("Por segurança, efetue o <strong><a href='user-login.php'>login</a></strong> novamente.");
            }
            else
                echo msgErro("Não foi possível alterar os dados.");
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