<?php

class Views{

  function __construct($view,$data = null,$data1 = null,$data2 = null){
    if(file_exists("./view/" . $view . ".php")){
      require("./view/" . $view . ".php");
    }else{
      die("Vista no encontrada");
    }
  }

}

 ?>
