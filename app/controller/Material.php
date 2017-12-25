<?php

class Material extends Controller{
  private $model;
  private $modelMaterial;

  function __construct(){
    $this->model = new LoadModel("MaterialModelo");
    $this->modelMaterial = new MaterialModelo();
    parent::__construct();
  }

  public function index(){
    $ev = $this->modelMaterial->getMateriales();
    $viewEventos = new Views("Materiales/formAltaMaterial",$ev);
  }

  public function altaMaterial(){
    $nombre = $_POST['txtMaterial'];
    $result = $this->modelMaterial->altaMaterial($nombre);
    if($result){
      new Views("Materiales/Respuesta","Material agregado con exito");
    }else{
      new Views("Materiales/Respuesta","Algo fallo");
    }
  }

}

 ?>
