<?php

$id = isset($_POST['id']) ? $_POST['id'] : '';
$descricao = $_POST['descricao'];
$placa = $_POST['placa'];
$codigoRenavam = $_POST['codigoRenavam'];
$anoModelo = $_POST['anoModelo'];
$anoFabricacao = $_POST['anoFabriacao'];
$cor = $_POST['cor'];
$km = $_POST['km'];
$marca = $_POST['marca'];
$preco = $_POST['preco'];
$precoFipe = $_POST['precoFipe'];
$opcionais = isset($_POST['opcionais']) ? $_POST['opcionais'] : '';

require_once "conexao.php";

$conex = Conexao::getInstance();

if(empty($id)){
    $auxMarca = !empty($marca) ? 'marca, ' : '';
    $auxMarca2 = !empty($marca) ? "'{$marca}', " : '';
    $id = $conex->insert("insert into veiculo (descricao, placa, codigoRenavam, anoModelo, anoFabricacao, cor, {$auxMarca} km, preco, precoFipe) 
    values ('{$descricao}', '{$placa}','{$codigoRenavam}','{$anoModelo}','{$anoFabricacao}','{$cor}','{$km}', {$auxMarca2} '{$preco}','{$precoFipe}')");
    $conex->delete("delete from veiculo_opcional where idVeiculo = {$id}");
    if(!empty($opcionais)){
        foreach($opcionais as $op) {
            $conex->insert("insert into veiculo_opcional (idVeiculo, idOpcional) values ({$id}, {$op})");
        }
    }
} else {
    $auxMarca = !empty($marca) ? $marca : null;
    $conex->update("update veiculo set descricao = '{$descricao}', placa = '{$placa}', codigoRenavam = '{$codigoRenavam}', 
    anoModelo = '{$anoModelo}', anoFabricacao = '{$anoFabricacao}', cor = '{$cor}', km = '{$km}', marca = '{$auxMarca}', preco = '{$preco}', precoFipe = '{$precoFipe}' where id = '{$id}'");
    $conex->delete("delete from veiculo_opcional where idVeiculo = {$id}");
    if(!empty($opcionais)){
        foreach($opcionais as $op) {
            $conex->insert("insert into veiculo_opcional (idVeiculo, idOpcional) values ({$id}, {$op})");
        }
    }
}


header('Location: cadastroVeiculoView.php?sucesso=1');
