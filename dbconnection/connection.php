<?php 
session_start();
define('BR','<br>');
 $db = mysqli_connect('localhost', 'root', 'password','dbname') or
        die ('Unable to connect. Check your connection parameters.');
?>