<?php
    function thumb($arq){
        $caminho="fotos/$arq";
        if (is_null($arq) || !file_exists($caminho))
            return "fotos/indisponivel.png";
        else
            return $caminho;
    }

    function voltar(){
        return "<a href='index.php'><span class='material-symbols-outlined'>
        arrow_back
        </span></a>";
    }

    function msgSucesso($msg){
        $resp="<div class='sucesso'><span class='material-symbols-outlined'>
        check_circle</span> $msg</div>";
        return $resp;
    }

    function msgAviso($msg){
        $resp="<div class='aviso'><span class='material-symbols-outlined'>
        info</span> $msg</div>";
        return $resp;
    }

    function msgErro($msg){
        $resp="<div class='erro'><span class='material-symbols-outlined'>
        error</span> $msg</div>";
        return $resp;
    }
?>