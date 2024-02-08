<?php
session_start();// Sessionnummer wird erzeugt
                // Cookie wird versendet   
                // in der Session lassen sich Daten abspeichern
                // zerfällt wenn Browser geschlossen wird

//dynamisch/automatisches Laden von Klassen
spl_autoload_register(
    function($class){
        include 'class_'.$class.'.php';
    });

class Controller{
    private $r;//merke dir die Anfragen/key vom Querystring
    //eine Klasse hat Methoden
    function __construct()// Automatisch bei new Objekt
    {
      $this->r = $_REQUEST;// POST /GET  z.B. ?text=Hallo
      switch(key($this->r)){ // text
        case 'text': $this->setMessage();
                     break;
        case 'laden':$this->getMessage();
                     break;
        case 'checklogin':$this->ChangeInput();
                     break; 
        case 'user': $this->setLogin();
                     break;
        case 'logout':$this->setLogout();
                     break;                                           
        default: header('Location:../chat.php');
      }
    }
    private function setLogout(){
      session_destroy();//Löschen der Kompletten Session
      header('Location:../chat.php');//Neuaufbau mit Anmeldefenster
    }
    
    private function setLogin(){
      $name = $this->r['user'];// ?user=Max
      $_SESSION['user'] = $name;
      header('Location:../chat.php');//Ansicht aktualisieren
    }

    private function ChangeInput(){
      $instanz = new View;
      if(isset($_SESSION['user'])){// wenn User angemeldet ist
         $instanz->setLayout('input','');//editieren möglich
      }else{
         $instanz->setLayout('login','');//Anmeldung mit Namen
      }  
    }

    private function setMessage(){
      $message = htmlspecialchars(strip_tags($this->r['text'],'<a>'));//XSS Schutz alle Tags entfernen, Links erlaubt
      $message = nl2br($message);// \r\n zu br
      $suche = ["\r","\n",";","fuck"];
      $ersetze = ["", "" ,",","f***"];
      $message = str_replace($suche , $ersetze, $message );//ersetze \r\n durch nix
      $name = $_SESSION['user'];
      Model::writeMyMessage($name,$message);// Zugriff statisch auf Klasse
      header('Location:../chat.php');//get Query
    }
    private function getMessage(){
      $array = Model::readMyMessage();
      $instanz = new View;
      $instanz->setLayout('message',$array);  
    }

}

new Controller();
?>