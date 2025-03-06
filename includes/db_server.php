<?php
 define('DB_SERVER','localhost');
 define('DB_USER','wisepaq_website');
 define('DB_PASS','wisepaq@website');
 define('DB_NAME','wisepaq_website');
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
 mysqli_set_charset($connection,"utf8mb4");
// Check connection
if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>