<?php

class Conexion{

  public static function conectar(){
    require_once('datosConexion.php');
    $conexion = new mysqli($datos["host"], $datos["user"], $datos["password"], $datos["database"]);
    if(!$conexion){
      $conexion = false;
    }
    return $conexion;
  }

}

 ?>
