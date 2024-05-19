<?php
const DB_SERVER = '127.0.0.1';
const DB_NAME = 'property_management';
const DB_USERNAME = 'mysqluser';
const DB_PASSWORD = 'password';

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

