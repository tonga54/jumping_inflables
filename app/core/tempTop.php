<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jumping Inflables</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/print.css" media="print">
    <link rel="stylesheet" href="../public/css/fonts.css">
    <link rel="stylesheet" href="../public/css/style.css">

    <style media="screen">

      table{
        text-align: center;
      }
      .art{
        width: 45%;
        display: inline-block;
        box-sizing: border-box;

      }

      .stats{
        text-align: center;
      }

      .stats header{
        text-align:center;
        width: 47%;
        display: inline-block;
      }


    </style>


  </head>
  <body>
    <div class="container">
        <header id="header">
            <div class="logo">
                 <a href="index.php?controller=Backup&action=crearBackup"><span class="icon-checkmark"> </span>Correr Backup</a>
            </div>
        </header>
        <nav>
           <ul>
              	    <li><a href="index.php"><span class="icon-home"> </span><span class="info">Inicio</span></a></li>
                    <li><a href="index.php?controller=Evento&action=buscarEventosXFecha"><span class="icon-search"> </span><span class="info">Buscar por Fecha</span></a></li>
                    <li><a href="index.php?controller=Evento&action=formAltaEvento"><span class="icon-folder-plus"> </span><span class="info">Registrar evento</span></a></li>
                    <li><a href="index.php?controller=Material"><span class="icon-list2"> </span><span class="info">Agregar Materiales</span></a></li>
                    <li><a href="index.php?controller=Caja"><span class="icon-clipboard"> </span><span class="info">Caja</span></a></li>
                    <!-- <li><a href="#"><span class="icon-clipboard"> </span><span class="info">Eventos que no utilizan un servicio</span></a></li> -->
           </ul>
        </nav>
        <section>
          <div class="sectionContainer">
