<?php
require_once 'config.php'; 
$conn = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPass"); 
	if (!$conn) {
    die("PostgreSQL Connection failed: " . pg_last_error());
} else {
   //echo "Successfully connected to the database!";
}

//PDO METHOD //
// $dsn = "pgsql:host=localhost;port=5432;dbname=curd_learn";
// try {
//     $conn = new PDO($dsn, "postgres", "admin");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {echo($e);
//     echo "Connection failed: " . $e->getMessage();
// }
?>