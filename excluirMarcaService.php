<?php

$ids = $_GET['ids'];

require_once "conexao.php";

$conex = Conexao::GetInstance();

$conex->delete("delete from marca where id in ({$ids})");

header('Location: cadastroMarcaView.php?exclusao=1');