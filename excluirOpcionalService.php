<?php

$ids = $_GET['ids'];

require_once "conexao.php";

$conex = Conexao::GetInstance();

$conex->delete("delete from opcional where id in ({$ids})");

header('Location: cadastroOpcionalView.php?exclusao=1');