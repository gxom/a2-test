<?php //database-connection.php

    try 
    {
        $connect = new PDO("mysql:host=localhost;dbname=a2_prueba","root","");
    }
    catch (PDOException $e)
    {
        echo "ERROR: " . $e->getMessage();
        die();
    }

?>