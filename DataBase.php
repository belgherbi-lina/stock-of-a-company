<?php
    $username = "root";
    $password = "";
    try{
    $db = new PDO("mysql:host=localhost;dbname=website",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    
    }catch(exception $e) {
        echo $e ;
    }
?>