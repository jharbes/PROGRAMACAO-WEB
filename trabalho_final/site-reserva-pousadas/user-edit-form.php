<?php
    $q="SELECT email,nome,senha,tipo FROM usuario WHERE email='".$_SESSION['user']."'";
    $busca=$banco->query($q);
    $reg=$busca->fetch_object();
?>
<h2>Alteração de dados do usuário</h2>
<form action="user-edit.php" method="post">
    <table>
        <tr><td><label for="usuario">Usuário: </label></td><td><input type="text" name="usuario" id="usuario" maxlength="40" size="30" required readonly value="<?php echo $reg->email ?>"></td></tr>
        <tr><td><label for="nome">Nome: </label></td><td><input type="text" name="nome" id="nome" maxlength="30" size="30" required value="<?php echo $reg->nome ?>"></td></tr>
        <tr><td><label for="tipo">Tipo: </label></td><td><input type="text" name="tipo" id="tipo" readonly value="<?php echo $reg->tipo ?>"></td></tr>
        <tr><td><label for="senha1">Senha: </label></td><td><input type="password" name="senha1" id="senha1" maxlength="10" size="10"></td></tr>
        <tr><td><label for="senha2">Senha: </label></td><td><input type="password" name="senha2" id="senha2" maxlength="10" size="10"></td></tr>
    </table>
    <div id="entrar"><input type="submit" value="Salvar Alterações" id="botao-entrar"></div>
</form>