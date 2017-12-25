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
    $dmp = "C:\\xampp\mysql\bin\mysqldump";
    $dbhost = "localhost";
    $dbuser = "gaston";
    $dbpass = "kalu1234";
    $dbname = "jumpinginflables";
    $fecha = date("Ymd-His");

    $salida_sql = $dbname.'_'.$fecha.'.sql';
    $dump = "$dmp -h$dbhost -u$dbuser -p$dbpass --opt $dbname > ../backups/$salida_sql";
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
