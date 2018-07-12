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
    $this->cliente = ucwords($cliente);
    $this->telefono = $telefono;
    $this->fecha = $fecha;
    $this->horaInicio = $horaInicio;
    $this->horaFin = $horaFin;
    $this->cantChicos = $cantChicos;
    $this->direccion = ucfirst($direccion);
    $this->observaciones = ucfirst($observaciones);
    $this->costo = $costo;
    $this->duracion = $duracion;
    $this->materiales = $slcMateriales;
    return $this->agregarEvento();
  }

  private function agregarEvento(){
    $sql = "INSERT INTO Evento (id,cliente,telefono,fecha,horaInicio,horaFin,fechaRegistro,cantChicos,direccion,observaciones,costo,duracion,estado)
    VALUES (null,'" . $this->cliente . "','" . $this->telefono . "','" . $this->fecha . "','" . $this->horaInicio . "','" . $this->horaFin . "',NOW(),'" . $this->cantChicos . "',
    '" . $this->direccion . "','" . $this->observaciones . "','" . $this->costo . "','" . $this->duracion . "',true);";

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
    $sql = "UPDATE Evento SET cliente = '".ucwords($cliente)."',telefono = '".$telefono."',fecha = '".$fecha."',horaInicio = '".$horaInicio."',horaFin = '".$horaFin."',cantChicos = '".$cantChicos."',direccion = '".ucfirst($direccion)."',observaciones = '".ucfirst($observaciones)."',costo = '".$costo."',duracion = '".$duracion."'
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



//Quiero mostrar
  //Cantidad pop
  //Cantidad caramelos
  //Cantidad palitos

  public function obtenerInformacion($fechaInicial, $fechaFinal){
    $sql = " SELECT SUM(evento.cantChicos) as CantidadPop
              FROM evento,eventomaterial,material 
              WHERE evento.id = eventomaterial.idEvento AND
              eventomaterial.idMaterial = material.id AND
              material.nombre = 'Pop' AND
              evento.fecha >= '$fechaInicial' AND evento.fecha <= '$fechaFinal';";

    $sql .= " SELECT SUM(evento.cantChicos) as CantidadAlgodon
              FROM evento,eventomaterial,material
              WHERE evento.id = eventomaterial.idEvento AND
              eventomaterial.idMaterial = material.id AND
              material.nombre = 'Algodon de Azucar' AND
              evento.fecha >= '$fechaInicial' AND evento.fecha <= '$fechaFinal';";

    $sql .= " SELECT SUM(evento.cantChicos) as CantidadChicos
              FROM evento
              WHERE evento.fecha >= '$fechaInicial' AND evento.fecha <= '$fechaFinal';
            ";

    $arr = [
            "pop" => "",
            "algodon" => "",
            "chicos" => ""
           ];

    if ($result = $this->db->multi_query($sql)) {
      $i = 0;
      do {
          /* store first result set */
          if ($result = $this->db->store_result()) {
              while ($row = mysqli_fetch_row($result))   
              {
                if($i == 0){
                  $arr["pop"] = $row[0];
                }else if($i == 1){
                  $arr["algodon"] = $row[0];
                }else{
                  $arr["chicos"] = $row[0];
                }

                $i++;
              }
              mysqli_free_result($result);
          }   
      } while ($this->db->next_result());
    }

    return $arr;
  }

  public function getEstadisticas(){
    /*Cantidad de chicos promedio*/
    $sql = "SELECT AVG(evento.cantChicos)
    FROM evento;";

    /*Cantidad de veces que se solicitan las camas*/
    $sql .= "SELECT COUNT(eventomaterial.idMaterial) as cantCama
    FROM material,eventomaterial,evento
    WHERE material.id = eventomaterial.idMaterial AND
    evento.id = eventomaterial.idEvento AND
    evento.estado = true AND
    material.nombre LIKE '%Cama%';";

    /*Cantidad de veces que se solicitan los castillos*/
    $sql .= "SELECT COUNT(eventomaterial.idMaterial) as cantCastillo
    FROM material,eventomaterial,evento
    WHERE material.id = eventomaterial.idMaterial AND
    evento.id = eventomaterial.idEvento AND
    evento.estado = true AND
    material.nombre LIKE '%Castillo%';";

    /*Cantidad de veces que se solicitan los tejos*/
    $sql .= "SELECT COUNT(eventomaterial.idMaterial) as cantTejo
    FROM material,eventomaterial,evento
    WHERE material.id = eventomaterial.idMaterial AND
    evento.id = eventomaterial.idEvento AND
    evento.estado = true AND
    material.nombre LIKE '%Tejo%';";

    /*Cantidad de veces que se solicitan los futbolitos*/
    $sql .= "SELECT COUNT(eventomaterial.idMaterial) as cantFutbolito
    FROM material,eventomaterial,evento
    WHERE material.id = eventomaterial.idMaterial AND
    evento.id = eventomaterial.idEvento AND
    evento.estado = true AND
    material.nombre LIKE '%Futbolito%';";

    /*Cantidad de veces que se solicitan el algodon, el pop y la musica*/
    $sql .= "SELECT material.nombre, COUNT(eventomaterial.idMaterial) as cant
    FROM material,eventomaterial,evento
    WHERE material.id = eventomaterial.idMaterial AND
    evento.id = eventomaterial.idEvento AND
    evento.estado = true AND
    (material.nombre = 'POP' OR material.nombre = 'Algodon de azucar' OR material.nombre = 'Musica')
    GROUP BY (material.nombre);";

    /*Cantidad de eventos en cada hora*/
    $sql .= "SELECT evento.horaInicio,COUNT(evento.horaInicio)
    FROM evento 
    WHERE evento.estado = true
    GROUP BY(evento.horaInicio)
    ORDER BY (COUNT(evento.horaInicio)) DESC;";

    /*Que dias se trabaja mas*/
    $sql .= "SELECT (ELT(WEEKDAY(fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS DIA_SEMANA, COUNT((ELT(WEEKDAY(fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'))) as cantidadEventos
    FROM evento
    WHERE evento.estado = true
    GROUP BY (DIA_SEMANA)
    ORDER BY (cantidadEventos) DESC;";

    /*Que precio es el que se elije mas*/
    $sql .= "SELECT costo, COUNT(costo) as cantidad
    FROM evento
    WHERE estado = true
    GROUP BY (costo)
    HAVING COUNT(*) > 4
    ORDER BY (cantidad) DESC;";

    /*Que duracion la que se elije mas*/
    $sql .= "SELECT duracion, COUNT(duracion) as cantidad
    FROM evento
    WHERE estado = true
    GROUP BY (duracion)
    ORDER BY (cantidad) DESC;";
    

    $arr = [
            "promChicos" => "",
            "cantCama" => "",
            "cantCastillo" => "",
            "cantTejo" => "",
            "cantFutbolito" => "",
            "totalMat" => 0,
            "extras" => array(),
            "dias" => array(),
            "precios" => array(),
            "duracion" => array()
           ];

    if ($result = $this->db->multi_query($sql)) {
      $i = 0;
      do {
          /* store first result set */
          if ($result = $this->db->store_result()) {
              while ($row = mysqli_fetch_row($result))   
              {
                if($i == 0){
                  $arr["promChicos"] = $row[0];
                }else if($i == 1){
                  $arr["cantCama"] = $row[0];
                  $arr["totalMat"] += $row[0];
                }else if ($i == 2){
                  $arr["cantCastillo"] = $row[0];
                  $arr["totalMat"] += $row[0];
                }
                else if($i == 3){
                  $arr["cantTejo"] = $row[0];
                  $arr["totalMat"] += $row[0];
                }
                else if($i == 4){
                  $arr["cantFutbolito"] = $row[0];
                  $arr["totalMat"] += $row[0];
                }
                else if($i == 5){
                  if($row[0] == "Musica"){
                    $arr["totalMat"] += $row[1];
                  }
                  $arr["extras"][$row[0]] = $row[1];
                }
                else if($i == 6){
                  $arr["horas"][$row[0]] = $row[1];
                }
                else if($i == 7){
                  $arr["dias"][$row[0]] = $row[1];
                }
                else if($i == 8){
                  $arr["precios"][$row[0]] = $row[1];
                }
                else if($i == 9){
                  $arr["duracion"][$row[0]] = $row[1];
                }


              }
              mysqli_free_result($result);
              $i++;
          }   
      } while ($this->db->next_result());
    }

    return $arr;
  }

}

 ?>
