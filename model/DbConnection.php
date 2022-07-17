<?php
// Begin/resume session
session_start();
// Include necessary file
require_once 'User.php';



//Define variable for custom error messages
$errors = [];

// Define key variables for connection
$db_host = 'database';
$db_user = 'lamp';
$db_pass = 'lamp';
$db_name = 'lamp';

// Establish a new connection using PDO
try {
    $db_conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user = new User($db_conn);
    // Make use of database with users
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}