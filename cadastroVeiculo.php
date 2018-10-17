<?php
  require_once "cabecalho.php";

  if(isset($_GET['erro']) && !empty($_GET['erro'])) {
    echo "<div class='container mt-3'>";
    echo "<div class='alert alert-danger'>Preencha os campos obrigatórios!</div>";
    echo "</div>";
  }

  $id = isset($_GET['id']) ? $_GET['id'] : '';

  require_once "conexao.php";
  $conex = Conexao::getInstance();

  $marcaAux = '';
  $auxOpcionais = [];
  if(isset($id) && !empty(($id))) {
    
    $dados = $conex->select("select * from veiculo where id = {$id};");
    $marcaAux = $dados[0]['marca'];

    $opcionais = $conex->select("select idOpcional from veiculo_opcional where idVeiculo = {$id}");
    foreach($opcionais as $opcional) {
      $auxOpcionais[] = $opcional['idOpcional'];
    }
  }

  $marcas = $conex->select("select * from marca;");

  $optionMarca = "";
  foreach($marcas as $marca) {
    $checked = $marcaAux == $marca['id'] ? 'selected' : '';
    $optionMarca .= "<option  value='".$marca['id']."' $checked>".$marca['descricao']."</option>";
  }

  $todosOpcionais = $conex->select("select * from opcional;");

  $checksOPcionais = "<div class='alert alert-primary'>Não existem Adicionais cadastrados! Acesse <strong>Cadastro > Adicional</strong> para cadastrar.</div>";
  if(!empty($todosOpcionais)){
    $checksOPcionais = "";
    foreach($todosOpcionais as $op) {
      $checked = in_array($op['id'], $auxOpcionais) ? 'checked' : '';
      $checksOPcionais .= '<div style="display: inline-block;">
                            <input type="checkbox" '.$checked.' class="" id="check'.$op['id'].'" name="opcionais[]" value="'.$op['id'].'">
                            <label class="mr-3" for="check'.$op['id'].'">'.$op['descricao'].'</label>
                          </div>';
    }
  }

?>
    

<div class="container">
  <h3 class="mb-3">Veículos</h3>
  <form action="cadastroVeiculoService.php" method="post">
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
              <input required type="text" class="form-control" id="descricao" name="descricao" placeholder="Golf GTI" value="<?=empty($dados) ? '' : $dados[0]['descricao'];?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="placa">Placa*</label>
                <input required type="text" class="form-control" id="placa" name="placa" placeholder="abc1234" value="<?=empty($dados) ? '' : $dados[0]['placa'];?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="codigoRenavam">Código RENAVAM*</label>
                <input required type="text" class="form-control" id="codigoRenavam" name="codigoRenavam" placeholder="12312312312" value="<?=empty($dados) ? '' : $dados[0]['codigoRenavam'];?>"> 
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
              <label for="anoModelo">Ano modelo*</label>
              <input required type="number" class="form-control" id="anoModelo" name="anoModelo" placeholder="2019" value="<?=empty($dados) ? '' : $dados[0]['anoModelo'];?>">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
              <label for="anoFabriacao">Ano fabricação*</label>
              <input required type="number" class="form-control" id="anoFabriacao" name="anoFabriacao" placeholder="2018" value="<?=empty($dados) ? '' : $dados[0]['anoFabricacao'];?>">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
              <label for="cor">Cor*</label>
              <input required type="text" class="form-control" id="cor" name="cor" placeholder="Preto" value="<?=empty($dados) ? '' : $dados[0]['cor'];?>">
          </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="km">KM*</label>
                <input required type="text" class="form-control" id="km" name="km" placeholder="60000" value="<?=empty($dados) ? '' : $dados[0]['km'];?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="marca">Marca*</label>
                <select type="text" class="form-control" id="marca" name="marca">
                  <option value="0">Selecione</option>
                  <?= empty($optionMarca) ? '' : $optionMarca ?>
                </select>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="preco">Preço*</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input required type="number" class="form-control" id="preco" name="preco" placeholder="150000" value="<?=empty($dados) ? '' : $dados[0]['preco'];?>">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="precoFipe">Preço FIPE*</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input required type="number" class="form-control" id="precoFipe" name="precoFipe" placeholder="145000" value="<?=empty($dados) ? '' : $dados[0]['precoFipe'];?>">
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col">
          <h5 class="mt-3">Componentes adicionais</h4>
          <?= empty($checksOPcionais) ? '' : $checksOPcionais ?>
        </div>
      </div>
      <input type="submit" class="btn btn-primary" value="Salvar">
      <a class="btn btn-secondary" onclick="window.location.href='cadastroVeiculoView.php'" href="#">Cancelar</a>
      </form>
    </div>

<?php
  require_once "rodape.php";
?>