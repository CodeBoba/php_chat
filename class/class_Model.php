<?php
   class Model{
    public static function writeMyMessage($name,$message){
        $zeit = date('H:i'); //Stunde:Min
        file_put_contents('../log/message.csv', $name.';'.$zeit.';'.$message."\r\n",FILE_APPEND);
    }
    public static function readMyMessage(){
        // Lesen ein File in ein Array /r/n
        $array = file('../log/message.csv',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $array;
    }

   }
?>