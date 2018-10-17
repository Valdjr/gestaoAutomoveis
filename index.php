<?php
  require_once "cabecalho.php";
  require_once "conexao.php";

  $conexao = Conexao::getInstance();

  $dados = $conexao->select("select count(*) as qnt from veiculo");


?>

<div class="container">
  <div class="card" style="width: 18rem; box-shadow: 10px 10px 5px grey;">
    <h3 style="text-align: center"><?=$dados[0]['qnt']?></h3>
    <h4 style="text-align: center">Total de veículos</h4>
  </div>
</div>
    

<?php
  require_once "rodape.php";
?>