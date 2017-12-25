<?php

class CajaMOdelo{
  private $db;

  public function __construct(){
    require_once('./core/conexion.php');
    $this->db = Conexion::conectar();
  }

  public function getIncidencias(){
    $sql = "SELECT nombre,fecha,valor FROM caja ORDER BY(fecha) DESC LIMIT 10";
    $result = $this->db->query($sql);
    return $result;
  }

  public function altaIncidencia($nombre,$fecha,$valor){
    $sql = "INSERT INTO caja (id,nombre,fecha,valor) VALUES (null,'$nombre','$fecha','$valor')";
    $this->db->query($sql);
    if($this->db->affected_rows == 1){
      return true;
    }else{
      return false;
    }
  }

  public function getTotal(){
    $sql = "SELECT SUM(valor) as total FROM caja;";
    $result = $this->db->query($sql);
    return $result;
  }

}

 ?>
