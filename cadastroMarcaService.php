<?php

$id = isset($_POST['id']) ? $_POST['id'] : '';
$descricao = $_POST['descricao'];

if(empty($descricao)) {
    header('Location: cadastroMarca.php?erro=1');
} else {
    require_once "conexao.php";
    
    $conex = Conexao::getInstance();
    
    if(empty($id)){
        $conex->insert("insert into marca (descricao) values ('{$descricao}')");
    } else {
        $conex->update("update marca set descricao = '{$descricao}' where id = '{$id}'");
    }
    
    header('Location: cadastroMarcaView.php?sucesso=1');
}
