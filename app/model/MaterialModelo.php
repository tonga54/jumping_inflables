<?php

class MaterialModelo{
  private $db;
  private $nombre;
  private $eventos;

  public function __construct(){
    require_once('./core/conexion.php');
    $this->db = Conexion::conectar();
  }

  public function altaMaterial($nombre){
    $this->nombre = $nombre;
    $sql = "INSERT INTO material (id,nombre) VALUES (null,'$this->nombre')";
    $this->db->query($sql);
    if($this->db->affected_rows == 1){
      return true;
    }else{
      return false;
    }
  }

  public function getMateriales(){
    $sql = "SELECT * FROM material";
    $this->eventos = $this->db->query($sql);
    return $this->eventos;
  }

}

 ?>
