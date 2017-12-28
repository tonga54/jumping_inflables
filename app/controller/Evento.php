<?php

class Evento extends Controller{
  private $model;
  private $modelEvento;

  function __construct(){
    $this->model = new LoadModel("EventoModelo");
    $this->modelEvento = new EventoModelo();
    parent::__construct();
  }

  public function index(){
    /*$materiales = $this->modelEvento->cargarMateriales();
    new Views("Eventos/formAltaEvento",$materiales);*/
  }

  public function mostrarUltimos10Eventos(){
    return $this->modelEvento->mostrarUltimos10Eventos();;
  }

  public function cantidadEventosXMes(){
    return $this->modelEvento->cantidadEventosXMes();;
  }

  public function cantidadDineroXMes(){
    return $this->modelEvento->cantidadDineroXMes();;
  }

  public function formAltaEvento(){
    $materiales = $this->modelEvento->cargarMateriales();
    new Views("Eventos/formAltaEvento",$materiales);
  }

  public function buscarEventosXFecha(){
    $eventos = null;
    $fecha = null;
    if(isset($_POST['txtFecha'])){
      $fecha = $_POST['txtFecha'];
      $eventos = $this->modelEvento->buscarEventosXFecha($fecha);
    }

    new Views("Eventos/formBuscarEvento",$eventos,$fecha);
  }

  public function altaEvento(){

    $cliente = $_POST['txtCliente'];
    $telefono = $_POST['txtTelefono'];
    $fecha = $_POST['txtFecha'];
    $horaInicio = $_POST['txtHoraInicio'];
    $horaFin = $_POST['txtHoraFin'];
    $cantChicos = $_POST['txtCantChicos'];
    $direccion = $_POST['txtDireccion'];
    $observaciones = $_POST['txtObservaciones'];
    $costo = $_POST['txtCosto'];
    $duracion = $_POST['txtDuracion'];
    $materiales = $_POST['slcMateriales'];

    $result = $this->modelEvento->altaEvento($cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion,$materiales);
    if($result){
      new Views("Eventos/Respuesta","Evento agregado con exito");
    }else{
      new Views("Eventos/Respuesta","Algo fallo");
    }
  }

  public function editarEvento(){
    $id = $_GET['idEvento'];
    $result = $this->modelEvento->getById($id);
    new Views("Eventos/editarEvento",$result);
  }

  public function editarEventoProceso(){
    $id = $_POST['txtId'];
    $cliente = $_POST['txtCliente'];
    $telefono = $_POST['txtTelefono'];
    $fecha = $_POST['txtFecha'];
    $horaInicio = $_POST['txtHoraInicio'];
    $horaFin = $_POST['txtHoraFin'];
    $cantChicos = $_POST['txtCantChicos'];
    $direccion = $_POST['txtDireccion'];
    $observaciones = $_POST['txtObservaciones'];
    $costo = $_POST['txtCosto'];
    $duracion = $_POST['txtDuracion'];

    $result = $this->modelEvento->editarEvento($id,$cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion);
    if($result){
      new Views("Eventos/Respuesta","Evento editado con exito");
    }else{
      new Views("Eventos/Respuesta","Algo fallo");
    }
  }


}

 ?>
