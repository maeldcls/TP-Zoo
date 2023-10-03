<?php
$dns = "mysql:host=localhost;dbname=zoo";
$user = "root";
$password = "";

try {
    $bdd = new PDO ($dns,$user,$password);
} catch (Exception $message) {
    echo "il y a un problème de souci <br>" . "<pre>$message</pre>";
}