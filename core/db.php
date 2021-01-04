<?php
function getdb() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'import_csv_file';

    try {
        $conn = mysqli_connect($host, $user, $pass, $db_name);
    } catch (exeption $w) {
        echo "Connection Failed. " . $e->getMessage();
    }
    return $conn;
}