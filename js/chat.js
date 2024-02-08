
// Select für Messagefenster
var fenster = document.getElementById('message');

function myAutoUpdate(){
    var instanz = new XMLHttpRequest();// AJAX Objekt
    instanz.open('get','class/class_Controller.php?laden=true');
    instanz.onreadystatechange = function(){
    // Vollständig im Arbeitsspeicher && der Server hat Anwort verschickt
    if(instanz.readyState == 4 && instanz.status == 200){
        //Schreiben in Messagefenster
        fenster.innerHTML = instanz.responseText;//Text vom Server
        fenster.scrollTop =  fenster.scrollHeight;//automatisch runterscrollen
    }
    }
  instanz.send();//starten asynchroner komplexer Prozess
}
//Aufruf regelmäßig
setInterval('myAutoUpdate()',2000);// alle 2sec Funktion aufrufen
myAutoUpdate();// sofort laden

//############################## Wechsel InputBereich #############
var bereich = document.getElementById('changeInput');
var instanz = new XMLHttpRequest();
instanz.open('get','class/class_Controller.php?checklogin=true');
instanz.onreadystatechange = function(){
    if(instanz.readyState == 4 && instanz.status == 200){
        //Schreiben in Messagefenster
        bereich.innerHTML = instanz.responseText;//Text vom Server
    }
}
instanz.send();

