<?php

class LoadModel{
  function __construct($model){
    require "./model/" . $model . ".php";
  }
}

 ?>
