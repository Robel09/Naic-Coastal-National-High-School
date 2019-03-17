<?php

// Data Base Config file
if($_SERVER['SERVER_ADDR']=="8.8.8.8"){
    // Production config DB
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','password');
    define('DB_NAME','apmak_elearn');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}
else{
    // Developer server
    define('HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD','');
    define('DB_NAME','apmak_elearn');
    define('DB_DRIVER','mysql');
    define('CHARSET','utf8');
}
$conn = mysqli_connect(HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("ERROR");

?>
