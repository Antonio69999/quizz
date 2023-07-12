<?php
$dns = 'mysql:host=localhost;dbname=quizz';
$user = 'root';
$password = '';

try { //on test d'y acceder
    $db = new PDO( $dns, $user, $password); //variable $db qui recupere base de donnée grâce à new PDO

} 

catch (Exception $message) {
    echo ("There is a problem <br>". "<pre>$message</pre>"); //si exception on catch et on l'affiche
}

?>