<?php

class LoadController{
  function __construct($model){
    require "./controller/" . $model . ".php";
  }
}

 ?>
