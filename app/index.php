<?php

require("core/Controller.php");
require("core/Config.php");
require("core/View.php");
require("core/LoadModel.php");
require("core/LoadController.php");

/*if($_GET && isset($_GET["controller"])){
  $default_controller = $_GET["controller"];

  if(file_exists("controller/" . $default_controller . ".php")){
    require("controller/" . $default_controller . ".php");
  }
  else{
    die("Controlador no encontrado");
  }
}
else{
  if(file_exists("controller/" . $default_controller . ".php")){
    require("controller/" . $default_controller . ".php");
  }else{
    die("Controlador no encontrado");
  }
}
*/


if($_GET && isset($_GET["controller"])){
  $default_controller = $_GET["controller"];
  if(!file_exists("controller/" . $default_controller . ".php")){
    die("Controlador no encontrado");
  }
}

require("controller/" . $default_controller . ".php");

$jumping = new $default_controller();


?>
