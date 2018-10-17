<?php

$ids = $_GET['ids'];

require_once "conexao.php";

$conex = Conexao::GetInstance();

$conex->delete("delete from veiculo where id in ({$ids})");

header('Location: cadastroVeiculoView.php?exclusao=1');