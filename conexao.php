<?php

class Conexao {

    private static $conexao;

    static function getInstance() {
        if (self::$conexao == null) {
            $conexao = new Conexao();
        }
        return $conexao;
    }

    private function __construct() {
        self::$conexao = mysqli_connect('localhost','root','asdf000', 'veiculos');
        if (!self::$conexao) {
            echo "Failed to connect to MySQL: (" . self::$conexao->connect_errno . ") " . self::$conexao->connect_error;
        }
    }

    public function select($consulta){
        $res = mysqli_query(self::$conexao, $consulta);
        $resultado = [];
        while($obj = mysqli_fetch_array($res)){
            $resultado[] = $obj;
        }
        return $resultado;
    }

    public function insert($insert){
        mysqli_query(self::$conexao, $insert);
        return mysqli_insert_id(self::$conexao);
    }

    public function update($update){
        mysqli_query(self::$conexao, $update);
    }

    public function delete($delete){
        mysqli_query(self::$conexao, $delete);
    }

}

