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
    if(isset($_GET['idEvento']) && $_GET['idEvento'] != ""){
        $id = $_GET['idEvento'];
        $evento = $this->modelEvento->getById($id);
        if($evento != null){
          $materiales = $this->modelEvento->cargarMateriales();
          $aux = "";
          while($fila = $materiales->fetch_assoc()){
            $aux .= "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
          }
          $materiales = $aux;
          $evento = $evento->fetch_assoc();
          new Views("Eventos/editarEvento",$evento,$materiales);
        }else{
          new Views("Eventos/Respuesta","No existe el evento");
        }
    }else{
      new Views("Eventos/Respuesta","No existe el evento");
    }

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

    if(isset($_POST['slcMateriales'])){
      $materiales = $_POST['slcMateriales'];
      $result = $this->modelEvento->editarEvento($id,$cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion,$materiales);
    }else{
      $result = $this->modelEvento->editarEvento($id,$cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion);
    }


    if($result){
      new Views("Eventos/Respuesta","Evento editado con exito");
    }else{
      new Views("Eventos/Respuesta","Algo fallo");
    }
  }

  public function sugerirMateriales(){
    $fecha = $_GET['fecha'];
    $inicio = $_GET['inicio'];
    $fin = $_GET['fin'];
    $result = $this->modelEvento->sugerirMateriales($fecha,$inicio,$fin);
    $retorno = "<table id='tblMateriales' class='hidden-print'>
      <tbody>";
      $i = 1;
      $x = 0;
      while($fila = $result->fetch_assoc()){

        if($i % 3 == 0){
          $retorno .= "<td>" . $fila['nombre'] . "</td>";
          $retorno .= "</tr>";
          $x = 0;
        }else{
          $x++;
          if($x == 1){
          $retorno .= "<tr>";
          }
          $retorno .= "<td>" . $fila['nombre'] . "</td>";
        }
        $i++;
      }
      $retorno .= "
     </tbody>
   </table>";
    echo $retorno;
  }

  public function eliminarEvento(){
    if(isset($_GET['idEvento'])){
      $id = $_GET['idEvento'];

      $result = $this->modelEvento->eliminarEvento($id);

      if($result){
        new Views("Eventos/Respuesta","Evento eliminado con exito");
      }else{
        new Views("Eventos/Respuesta","Error a la hora de eliminar el evento");
      }

    }else{
      new Views("Eventos/Respuesta","Indice invalido");
    }

  }

  public function getInformacion(){
    $hoy = getdate();
    if($hoy['weekday'] == "Saturday"){
      $fechaInicial=date("Y-m-d",strtotime("-7 day", strtotime("next saturday")));
      $fechaFinal=date("Y-m-d",strtotime("-7 day", strtotime("next sunday")));
    }
    else{
      $fechaInicial=date("Y-m-d",strtotime("next saturday"));
      $fechaFinal=date("Y-m-d",strtotime("next sunday"));
    }

    $informacion = $this->modelEvento->obtenerInformacion($fechaInicial,$fechaFinal);
    new Views("Eventos/getInformacion",$informacion);
  }

  public function getEstadisticas(){
    $estadisticas = $this->modelEvento->getEstadisticas();
    new Views("Eventos/getEstadisticas",$estadisticas);
  }


}

 ?>
