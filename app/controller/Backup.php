<?php

class Backup extends Controller{
  private $model;
  private $modelEvento;

  function __construct(){
    $this->model = new LoadModel("BackupModelo");
    $this->modelBackup = new BackupModelo();
    parent::__construct();
  }

  public function index(){

  }

  public function crearBackup(){
    $info = $this->modelBackup->crearBackup();
    $viewEventos = new Views("System/backupInfo",$info);
  }


}

 ?>
