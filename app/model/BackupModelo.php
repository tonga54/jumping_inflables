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
    $nombreArchivo = $datos['database'].'_'.$fecha.'.sql';
    $dump = $path ." -h".$datos['host'] . " -u" . $datos['user'] . " -p" . $datos['password'] . " --opt " . $datos['database'] . " > ../backups/" . $nombreArchivo;
    system($dump,$output);

    if(!$output){
      if($this->enviarBackup($nombreArchivo)){
        $devolucion = "Backup realizado y enviado con exito";
      }else{
        $devolucion = "Backup realizado con exito, pero no enviado";
        unlink($nombreArchivo);
      }
    }else{
      $devolucion = "No se a podido realizar el archivo de backup";
    }

    return $devolucion;

  }

  public function enviarBackup($nombreArchivo){
    $to = "emailDATA";
    $from = "LocalHost";
    $subject = "Backup JumpingInflables " . date("Y-m-d-H-i-s");
    $separator = md5(time());
    $filename = "../backups/".$nombreArchivo;
    $attachment = chunk_split(base64_encode(file_get_contents($filename)));

    $headers  = "From: ".$from.PHP_EOL;
    $headers .= "MIME-Version: 1.0".PHP_EOL;
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

    $body = "--".$separator.PHP_EOL;
    $body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".PHP_EOL;
    $body .= "Content-Transfer-Encoding: base64".PHP_EOL;
    $body .= "Content-Disposition: attachment".PHP_EOL.PHP_EOL;
    $body .= $attachment.PHP_EOL;
    $body .= "--".$separator."--";

    if (mail($to, $subject, $body, $headers)) {
        unlink($filename);
        return true;
    }else{
      return false;
    }
  }

}

 ?>
