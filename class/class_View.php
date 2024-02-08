<?php
class View{

    private $html;

public function setLayout($template,$data){
   // Template mit php/HTMl/css/JavaScript Programmierung
   // Server Bereich für PHP Berechnung
   ob_start(); // Puffer für Berechnungen auf Server
    require_once '../tpl/'.$template.'.tpl.php';
    ?>
    <!-- &copy JH -->
   <?php
   $this->html = ob_get_contents();//Puffer auslesen
   ob_end_clean();//Löschen des Puffers
   echo $this->html;//Ausgabe an User
}
}


?>