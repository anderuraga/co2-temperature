<?php

 
  $dbname   = "sensores";
  $user     = "root";
  $password = "";
  $server   = "localhost";
  
  $dsn = "mysql:host=$server;dbname=$dbname";
  $pdo = new PDO($dsn, $user, $password);
   
?>    