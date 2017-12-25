<?php

class Caja extends Controller{
  private $model;
  private $modelEvento;

  function __construct(){
    $this->model = new LoadModel("CajaModelo");
    $this->modelCaja = new CajaModelo();
    parent::__construct();
  }

  public function index(){
    $arrIncidencias = $this->modelCaja->getIncidencias();
    $total = $this->modelCaja->getTotal();
    new Views("Caja/formCaja",$arrIncidencias,$total);
  }

  public function altaIncidencia(){
    $nombre = $_POST['txtNombre'];
    $fecha = $_POST['txtFecha'];
    $valor = $_POST['txtValor'];
    $result = $this->modelCaja->altaIncidencia($nombre,$fecha,$valor);
    if($result){
      new Views("Caja/Respuesta","Incidencia agregada con exito");
    }else{
      new Views("Caja/Respuesta","Algo fallo");
    }
  }


}

 ?>
