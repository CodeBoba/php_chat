<?php

foreach($data as $zeile){
   list($name,$zeit,$message) = explode(';',$zeile);
   echo  '<div>'.$name.' <span>'.$zeit.'</span></div><br><div class="text">'.$message.'</div><br>';
}

?>