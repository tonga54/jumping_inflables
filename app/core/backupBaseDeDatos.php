<?php
   $dmp = "C:\\xampp\mysql\bin\mysqldump";
   $dbhost = "localhost";
   $dbuser = "gaston";
   $dbpass = "kalu1234";
   $dbname = "jumpinginflables";
   $fecha = date("Ymd-His");

   $salida_sql = $dbname.'_'.$fecha.'.sql';

   $dump = "$dmp -h$dbhost -u$dbuser -p$dbpass --opt $dbname > ../../backups/$salida_sql";

   system($dump,$output);

?>
