<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
    <link rel="shortcut icon" href="/icones/mario.ico" type="image/x-icon">
</head>
<body>
<?php
require_once 'includes/banco.php';
require_once 'includes/funcoes.php';
require_once 'includes/login.php';
$ordem=$_GET['o']??"n";
$chave=$_GET['c']??"";
?>
<div id="corpo">
    <?php include 'topo.php';?>
    <h1>Escolha seu Jogo</h1>
    <form id="busca" action="index.php" method="get">
        Ordenar: 
        <a href="index.php?o=n&c=<?php echo $chave; ?>">Nome</a> | 
        <a href="index.php?o=p&c=<?php echo $chave; ?>">Produtora</a> | 
        <a href="index.php?o=n1&c=<?php echo $chave; ?>">Nota Alta</a> | 
        <a href="index.php?o=n2&c=<?php echo $chave; ?>">Nota Baixa</a> | 
        <a href="index.php">Mostrar Todos</a> |
       <label for="ibusca">Buscar: </label><input type="text" name="c" size="10" maxlength="40" id="ibusca">
       <input type="submit" value="Ok">
    </form>
    <table class="listagem">
        <?php
        /*
            $q="select * from jogos j join generos g on j.genero=g.cod";
        */
            $q="select j.cod, j.nome, g.genero, p.produtora, j.capa from jogos j join generos g on j.genero=g.cod join produtoras p on j.produtora=p.cod ";

            if (!empty($chave)){
                $q.="where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
            }

            switch ($ordem){
                case "p":
                    $q.="order by p.produtora";
                    break;
                case "n1":
                    $q.="order by j.nota desc";
                    break;
                case "n2":
                    $q.="order by j.nota asc";
                    break;
                default:
                    $q.="order by j.nome";
            }
            $busca=$banco->query($q);
            if (!$busca)
                echo "<tr><td>Infelizmente a busca deu erro!</tr></td>";
            else{
                if ($busca->num_rows==0)
                    echo "<tr><td>Nenhum registro encontrado!</tr></td>";
                else{
                    while($reg=$busca->fetch_object()){
                        $t=thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini'/>";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                        echo " [$reg->genero]";
                        echo "<br>$reg->produtora";
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
</div>
<?php
include_once 'rodape.php';
?>
</body>
</html>