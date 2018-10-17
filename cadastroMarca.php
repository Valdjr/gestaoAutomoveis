<?php
  require_once "cabecalho.php";

  if(isset($_GET['erro']) && !empty($_GET['erro'])) {
    echo "<div class='container mt-3'>";
    echo "<div class='alert alert-danger'>Preencha os campos obrigatórios!</div>";
    echo "</div>";
  }

  $id = isset($_GET['id']) ? $_GET['id'] : '';
  if(isset($id) && !empty(($id))) {
    require_once "conexao.php";

    $conex = Conexao::getInstance();
    
    $dados = $conex->select("select * from marca where id = {$id}");
  }
?>
    

<div class="container">
  <h3 class="mb-3">Marcas</h3>
  <form action="cadastroMarcaService.php" method="post">
    <div class="row">
      <div class="col">
        <small class="form-text text-muted float-right">(*) Campos obrigatórios</small><br>
        <input type="hidden" value="<?=empty($id) ? '' : $id;?>" name="id">
      </div>
    </div>
      <div class="row">
        <div class="col">
            <div class="form-group">
              <label for="descricao">Descrição*</label>
              <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Volkswagen" value="<?=empty($dados) ? '' : $dados[0]['descricao'];?>">
            </div>
        </div>
      </div>
      <input type="submit" class="btn btn-primary" value="Salvar">
      <a class="btn btn-secondary" onclick="window.location.href='cadastroMarcaView.php'" href="#">Cancelar</a>
      </form>
    </div>

    <?php
  require_once "rodape.php";
?>