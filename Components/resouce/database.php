<?php
    $username = 'root';
    $dsn = 'mysql:host=127.0.0.1;dbname=register';
    $password = '';
    try {
        $db = new PDO($dsn , $username , $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connect to the register datbase";
    } catch (PDOException $ex) {
        //display error message
        echo "connect failed";
    }