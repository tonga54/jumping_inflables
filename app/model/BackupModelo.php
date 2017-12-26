<?php

class BackupModelo{
  // private $db;
  // private $nombre;
  // private $eventos;

  public function __construct(){
    // require_once('./core/conexion.php');
    // $this->db = Conexion::conectar();
  }

  public function crearBackup(){
    $path = "C:\\xampp\mysql\bin\mysqldump";
    require_once("././core/datosConexion.php");
    date_default_timezone_set('America/Montevideo');
    $fecha = date("d-m-Y_H-m-s");

    $salida_sql = $datos['database'].'_'.$fecha.'.sql';

    $dump = $path ." -h".$datos['host'] . " -u" . $datos['user'] . " -p" . $datos['password'] . " --opt " . $datos['database'] . " > ../backups/" . $salida_sql;
    system($dump,$output);

    if($output){
      $salida_sql = "Hubo un error";
    }else{
      $salida_sql = "Backup realizado con exito<br>".$salida_sql;
    }
    return $salida_sql;
  }

}

 ?>
