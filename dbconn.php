<?php

    $connection = new mysqli("localhost", "root", "", "akfadou");
    if ($connection->connect_error)
        die("Connection failed: " . $connection->connect_error);

?>

