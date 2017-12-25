<?php

class Predeterminado extends Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index(){
    $loadController = new LoadController("Evento");
    $backupController = new LoadController("Backup");
    $eventos = new Evento();
    $backup = new Backup();
    $ultimosDiez = $eventos->mostrarUltimos10Eventos();
    $cantidadEventosXMes = $eventos->cantidadEventosXMes();
    $cantidadDineroXMes = $eventos->cantidadDineroXMes();
    $view = new Views("Predeterminado",$ultimosDiez,$cantidadEventosXMes,$cantidadDineroXMes);
  }

}

?>
