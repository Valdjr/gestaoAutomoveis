<?php

$id = isset($_POST['id']) ? $_POST['id'] : '';
$descricao = $_POST['descricao'];

if(empty($descricao)) {
    header('Location: cadastroOpcional.php?erro=1');
} else {
    require_once "conexao.php";
    
    $conex = Conexao::getInstance();
    
    if(empty($id)){
        $conex->insert("insert into opcional (descricao) values ('{$descricao}')");
    } else {
        $conex->update("update opcional set descricao = '{$descricao}' where id = '{$id}'");
    }
    
    header('Location: cadastroOpcionalView.php?sucesso=1');
}
