<?php

class EventoModelo{
  private $db;
  private $id;
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

  private function agregarMateriales($id = null){
    if($id != null){
      $this->id = $id;
    }else{
      $this->id = $this->db->insert_id;
    }
    for ($i = 0; $i < Count($this->materiales);$i++){
      if($i == 0){
        $sql = "INSERT INTO eventomaterial VALUES ($this->id,".$this->materiales[$i].")";
      }else{
        $sql .= ",($this->id,".$this->materiales[$i].")";
      }
    }
    $this->db->query($sql);
  }

  public function mostrarEventos(){
    $sql = "SELECT * FROM Evento WHERE estado = true";
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
              WHERE estado = true
           group by e.id ORDER BY (fechaRegistro) DESC LIMIT 5";
    $this->eventos = $this->db->query($sql);
    return $this->eventos;
  }

  public function cantidadEventosXMes(){
    $sql = "SELECT CONCAT(MONTH(fecha), '-' ,YEAR(fecha)) as Fecha, COUNT(*) as CantidadEventos
            FROM Evento
            WHERE estado = true
            GROUP BY MONTH(fecha),YEAR(fecha)
            ORDER BY CantidadEventos DESC;";
    $r = $this->db->query($sql);
    return $r;
  }

  public function cantidadDineroXMes(){
    $sql = "SELECT CONCAT(MONTH(fecha), '-' ,YEAR(fecha)) as Fecha, SUM(Costo) as Total
            FROM Evento
            WHERE estado = true
            GROUP BY MONTH(Fecha),YEAR(Fecha)
            ORDER BY Total DESC;";
    $r = $this->db->query($sql);
    return $r;
  }

  public function cargarMateriales(){
    $sql = "SELECT * FROM material";
    $result = $this->db->query($sql);
    return $result;
  }

  public function buscarEventosXFecha($fecha){
    $sql = "select e.*, group_concat(m.nombre) as materiales
              from evento e
              left join (
                  select em.idEvento, m.nombre
                    from eventomaterial em
                    join material m
                      on m.id = em.idMaterial) m
                on m.idEvento = e.id WHERE fecha = '$fecha' AND estado = true
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
                on m.idEvento = e.id WHERE e.id = '$id' AND estado = true
             group by e.id ORDER BY (horaInicio)";
    $result = $this->db->query($sql);
    if($result->num_rows == 1){
      return $result;
    }else{
      return null;
    }

  }


  public function editarEvento($id,$cliente,$telefono,$fecha,$horaInicio,$horaFin,$cantChicos,$direccion,$observaciones,$costo,$duracion,$materiales = null){
    $sql = "UPDATE Evento SET cliente = '".$cliente."',telefono = '".$telefono."',fecha = '".$fecha."',horaInicio = '".$horaInicio."',horaFin = '".$horaFin."',cantChicos = '".$cantChicos."',direccion = '".$direccion."',observaciones = '".$observaciones."',costo = '".$costo."',duracion = '".$duracion."'
    WHERE id = ".$id."";
    $this->db->query($sql);

    if($materiales != null){
      $this->materiales = $materiales;
      $sql = "DELETE FROM EventoMaterial WHERE idEvento = '".$id."'";
      $this->db->query($sql);
      $this->agregarMateriales($id);
    }
    if($this->db->affected_rows > 0){
      return true;
    }else{
      return false;
    }
  }

  public function sugerirMateriales($fecha,$inicio,$fin){
    $sql = "SELECT nombre FROM Material WHERE id
            	NOT IN
            		(SELECT idMaterial FROM EventoMaterial WHERE idEvento
            				 IN
            					(SELECT id FROM Evento WHERE fecha = '".$fecha."' AND horaInicio < '".$fin."' AND horaFin > '".$inicio."' AND estado = true))";

    $result = $this->db->query($sql);
    return $result;
  }

  public function eliminarEvento($id){
    $bandera = true;
    // $sql  = "DELETE FROM EventoMaterial WHERE idEvento = '".$id."'";
    // $this->db->query($sql);

    // if($this->db->affected_rows <= 0){
      // $bandera = false;
    // }

    $sql  = "UPDATE Evento SET estado = false WHERE id = '".$id."'";
    $this->db->query($sql);

    if($this->db->affected_rows <= 0){
      $bandera = false;
    }

    return $bandera;

  }

}

 ?>
