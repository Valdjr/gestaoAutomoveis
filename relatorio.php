<?php
  require_once "cabecalho.php";
?>
    
<div class="container mt-3">
  <h3 class="mb-3">Veículos</h3>

<?php

require_once "conexao.php";

$conex = Conexao::getInstance();

$dados = $conex->select('select * from veiculo');

echo "<table class='table table-hover mt-3'>";
echo '<thead>
        <tr>
          <th scope="col">Descrição</th>
          <th scope="col">Placa</th>
          <th scope="col">Código RENAVAM</th>
          <th scope="col">Ano modelo</th>
          <th scope="col">Ano fabricação</th>
          <th scope="col">Cor</th>
          <th scope="col">KM</th>
          <th scope="col">Marca</th>
          <th scope="col">Preço</th>
          <th scope="col">Preço FIPE</th>
          </tr>
      </thead>';
if(empty($dados)){
  echo "</table>";
  echo "<div class='alert alert-primary'>A lista está vazia</div></div>";
} else {
  foreach($dados as $dado) {
    echo '<tr>
            <td>'.$dado['descricao'].'</td>
            <td>'.$dado['placa'].'</td>
            <td>'.$dado['codigoRenavam'].'</td>
            <td>'.$dado['anoModelo'].'</td>
            <td>'.$dado['anoFabricacao'].'</td>
            <td>'.$dado['cor'].'</td>
            <td>'.$dado['km'].'</td>
            <td>'.$dado['marca'].'</td>
            <td>'.$dado['preco'].'</td>
            <td>'.$dado['precoFipe'].'</td>
          </tr>';
  }

  echo "</table></div>";
}

require_once "rodape.php";
