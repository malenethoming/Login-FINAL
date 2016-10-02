<?php
$server = 'malenethoming.com.mysql';
$username = 'malenethoming_c';
$password = 'ruS5iiTS';
$database = 'malenethoming_c';

//connection to the database, if not - catch the error and execute 'connection failed'
//PDO secure way to connect
try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}