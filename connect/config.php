<?php
session_start();
require_once('initialize.php');
require_once('DBConnection.php');

$db = new DBConnection;
$conn = $db->conn;

/* if ($_SESSION['user'] == 1){
    header("Location: ../../../accrue/index.php");
} */

?>