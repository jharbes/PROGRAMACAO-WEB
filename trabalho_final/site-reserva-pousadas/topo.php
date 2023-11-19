<?php

echo "<header style='padding: 10px;'>";

if (empty($_SESSION['user']))
    echo "<a href='user-login.php'>Entrar</a>";
else{
    echo "Olá, <strong>".$_SESSION['nome']."</strong>! |  (usuário do tipo <strong>".$_SESSION['tipo']."</strong>) ";
    echo "<a href='user-edit.php'>Meus Dados</a> |";
    if (isAdmin()){
        echo " <a href='user-new.php'>Novo Usuário</a> |";
        echo " Novo Jogo |";
    }
    echo " <a href='user-logout.php'>Sair</a>";
}


echo "</header>";

?>