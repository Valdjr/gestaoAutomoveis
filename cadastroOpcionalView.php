<?php
  require_once "cabecalho.php";

  if(isset($_GET['sucesso']) && !empty($_GET['sucesso'])) {
    echo "<div class='container mt-3'>";
    echo "<div class='alert alert-success'>Cadastro efetuado com sucesso!</div>";
    echo "</div>";
  }

  if(isset($_GET['exclusao']) && !empty($_GET['exclusao'])){
    echo "<div class='container mt-3'>";
    echo "<div class='alert alert-success'>Exclusão efetuada com sucesso!</div>";
    echo "</div>";
  }
  
?>
    
<div class="container mt-3">
    <h3 class="mb-3">Adicionais</h3>
    <a class="btn btn-primary" href="cadastroOpcional.php">Incluir</a>
    <a class="btn btn-secondary" href="#" onclick="alterar()">Alterar</a>
    <a class="btn btn-danger" href="#" onclick="excluir()">Excluir</a>

<?php

  require_once "conexao.php";

  $conex = Conexao::getInstance();

  $count = $conex->select("select count(*) as qnt from opcional");

  $numrows = $count[0]['qnt'];
  $rowsperpage = 10;
  $totalpages = ceil($numrows / $rowsperpage);

  if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    $currentpage = (int) $_GET['currentpage'];
  } else {
    $currentpage = 1;
  }

  if ($currentpage > $totalpages) {
    $currentpage = $totalpages;
  }
  if ($currentpage < 1) {
    $currentpage = 1;
  }

  $offset = ($currentpage - 1) * $rowsperpage;
  $anterior = $currentpage == 1 ? 1 : $currentpage - 1;
  $proxima = $currentpage + 1 > $totalpages ? $totalpages : $currentpage + 1;

  $sql = "SELECT * FROM opcional LIMIT $offset, $rowsperpage";  
  
  $dados = $conex->select($sql);

  echo "<table class='table table-hover mt-3'>";
  echo '<thead>
          <tr>
            <th scope="col"><input type="checkbox" onclick="marcarTodos()" id="checkTodos"></th>
            <th scope="col">Descricao</th>
          </tr>
        </thead>';
  if(empty($dados)){
    echo "</table>";
    echo "<div class='alert alert-primary'>A lista está vazia</div></div>";
  } else {
    foreach($dados as $dado) {
      echo '<tr>
              <th><input type="checkbox" id="id'.$dado['id'].'" class="check"></th>
              <td onclick="alterar('.$dado['id'].')">'.$dado['descricao'].'</td>
            </tr>';
    }
  
    $pagination = '';
    if($numrows > 10) {
      $pagination = '<div class="row">
                      <div class="col">
                      <nav aria-label="Page navigation example" class="float-right">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="?currentpage='.$anterior.'">Anterior</a></li>
                          <li class="page-item"><a class="page-link" href="?currentpage='.$proxima.'">Próxima</a></li>
                        </ul>
                      </nav>
                      </div>
                    </div>';
    }

    echo '</table>'.$pagination.'</div>';
  }

?>

<script>

  function marcarTodos() {
    var checks = document.getElementsByClassName('check');
    var value = true;
    for (var check of checks) {
      if (check.checked) {
        value = false;
        break;
      }
    }
    for (var check of checks) {
      check.checked = value;
    }
    document.getElementById('checkTodos').checked = value;
  }

  function marcar(id) {
    var check = document.getElementById('id'+id).checked;
    document.getElementById('id'+id).checked = !check;
  }

  function alterar(id) {
    if(id != null) {
      window.location.href = 'cadastroOpcional.php?id='+id;
    } else {
      var checks = document.getElementsByClassName('check');
      var checados = [];
      for (var check of checks) {
        if (check.checked) {
          checados.push(check);
        }
      }
      if(checados.length > 1) {
        alert("Selecione apenas 1 opcional para alterar!");
      } else if (checados.length < 1) {
        alert("Selecione 1 opcional para alterar!");
      } else {
        var id = checados[0].id;
        var id = id.replace('id', '');
        window.location.href = 'cadastroOpcional.php?id='+id;
      }
    }
  }

  function excluir() {
    var checks = document.getElementsByClassName('check');
    var checados = [];
    for (var check of checks) {
      if (check.checked) {
        var id = check.id;
        checados.push(id.replace('id', ''));
      }
    }
    if(checados.length == 0) {
      alert("Selecione pelo menos 1 opcional para excluir!");
    } else {
      var ids = checados.join(',');
      window.location.href = 'excluirOpcionalService.php?ids='+ids;
    }
  }
</script>

<?php
require_once "rodape.php";
