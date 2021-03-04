<?php
    require 'config.php';

    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        die();
    }
?>

