<?php
require_once 'db-install.php';
try {
$dbh = new PDO('mysql:dbname=evg240_batch;host=localhost', $log, $passw);
} catch (PDOException $e) {
    die($e->getMessage());
}






