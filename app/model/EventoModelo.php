<?php

class EventoModelo{
  private $db;

  private $cliente;
  private $telefono;
  private $fecha;
  private $horaInicio;
  private $horaFin;
  private $cantChicos;
  private $direccion;
  private $observaciones;
  private $costo;
  private $duracion;
  private $materiales;
  private $eventos;

  public function __construct(){
    require_once('./core/conexion.php');
    $this->db = Conexion::conectar();
  }

  public function altaEvento($cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion,$slcMateriales){
    $this->cliente = $cliente;
    $this->telefono = $telefono;
    $this->fecha = $fecha;
    $this->horaInicio = $horaInicio;
    $this->horaFin = $horaFin;
    $this->cantChicos = $cantChicos;
    $this->direccion = $direccion;
    $this->observaciones = $observaciones;
    $this->costo = $costo;
    $this->duracion = $duracion;
    $this->materiales = $slcMateriales;
    return $this->agregarEvento();
  }

  private function agregarEvento(){
    $sql = "INSERT INTO Evento (id,cliente,telefono,fecha,horaInicio,horaFin,fechaRegistro,cantChicos,direccion,observaciones,costo,duracion)
    VALUES (null,'" . $this->cliente . "','" . $this->telefono . "','" . $this->fecha . "','" . $this->horaInicio . "','" . $this->horaFin . "',NOW(),'" . $this->cantChicos . "',
    '" . $this->direccion . "','" . $this->observaciones . "','" . $this->costo . "','" . $this->duracion . "');";

    $this->db->query($sql);
    if($this->db->affected_rows == 1){
      $this->agregarMateriales();
      return true;
    }else{
      return false;
    }
  }

  private function agregarMateriales(){
    $id = $this->db->insert_id;
    for ($i = 0; $i < Count($this->materiales);$i++){
      if($i == 0){
        $sql = "INSERT INTO eventomaterial VALUES ($id,".$this->materiales[$i].")";
      }else{
        $sql .= ",($id,".$this->materiales[$i].")";
      }
    }
    $this->db->query($sql);
  }

  public function mostrarEventos(){
    $sql = "SELECT * FROM Evento";
    $this->eventos = $this->db->query($sql);
    return $this->eventos;
  }

  public function filtrarXFecha(){

  }

  public function mostrarUltimos10Eventos(){
    $sql = "select e.*, group_concat(m.nombre) as materiales
            from evento e
            left join (
                select em.idEvento, m.nombre
                  from eventomaterial em
                  join material m
                    on m.id = em.idMaterial) m
              on m.idEvento = e.id
           group by e.id ORDER BY (fechaRegistro) DESC LIMIT 5";
    $this->eventos = $this->db->query($sql);
    return $this->eventos;
  }

  public function cantidadEventosXMes(){
    //$sql = "SELECT MONTH(fecha) as Fecha,COUNT(*) as CantidadEventos FROM Evento GROUP BY fecha";
    $sql = "SELECT Month(fecha) as Fecha,COUNT(*) as CantidadEventos FROM Evento GROUP BY Month(fecha) ORDER BY CantidadEventos DESC";
    $r = $this->db->query($sql);
    return $r;
  }

  public function cantidadDineroXMes(){
    $sql = "SELECT MONTH(Fecha) as Fecha,SUM(Costo) as Total FROM Evento GROUP BY (MONTH(Fecha)) ORDER BY Total DESC;";
    $r = $this->db->query($sql);
    return $r;
  }

  public function cargarMateriales(){
    $sql = "SELECT * FROM material";
    $result = $this->db->query($sql);
    return $result;
  }

  public function buscarEventosXFecha($fecha){
//     SELECT evento.*, group_concat(material.nombre)
// FROM evento,eventomaterial,material
// WHERE evento.id = eventomaterial.idEvento
// and idMaterial = material.id
// and evento.fecha = curdate()
// group by evento.id

    $sql = "select e.*, group_concat(m.nombre) as materiales
              from evento e
              left join (
                  select em.idEvento, m.nombre
                    from eventomaterial em
                    join material m
                      on m.id = em.idMaterial) m
                on m.idEvento = e.id WHERE fecha = '$fecha'
             group by e.id ORDER BY (horaInicio)";

    $result = $this->db->query($sql);
    return $result;
  }

  public function getById($id){
    $sql = "select e.*, group_concat(m.nombre) as materiales
              from evento e
              left join (
                  select em.idEvento, m.nombre
                    from eventomaterial em
                    join material m
                      on m.id = em.idMaterial) m
                on m.idEvento = e.id WHERE e.id = '$id'
             group by e.id ORDER BY (horaInicio)";
    $result = $this->db->query($sql);
    return $result;
  }


  public function editarEvento($id,$cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion){
    $sql = "UPDATE Evento SET cliente = '".$cliente."',telefono = '".$telefono."',fecha = '".$fecha."',horaInicio = '".$horaInicio."',horaFin = '".$horaFin."',cantChicos = '".$cantChicos."',direccion = '".$direccion."',observaciones = '".$direccion."',costo = '".$costo."',duracion = '".$duracion."'
    WHERE id = ".$id."";
    
    $this->db->query($sql);
    if($this->db->affected_rows > 0){
      return true;
    }else{
      return false;
    }
  }

}

 ?>
