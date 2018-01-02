<?php
date_default_timezone_set('America/Montevideo');
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Jumping Inflables</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="../public/css/print.css" media="print">
     <link rel="stylesheet" href="../public/css/fonts.css">
     <link rel="stylesheet" href="../public/css/style.css">
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
         	     <?php include("././core/tempMenu.php"); ?>
            </ul>
         </nav>
         <section>
           <div class="sectionContainer">
             <div id="section">
                 <header>
                     <h3>
                       <?php
                       echo $data;
                      ?>
                    </h3>
                 </header>
                 <article>


               </article>
               <footer>

               </footer>
            </div>
            <footer>

            </footer>
        </div>
  </body>
</html>
