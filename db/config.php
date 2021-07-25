<?php
/* Database credentials. */
define('DB_SERVER', 'sql301.epizy.com');
define('DB_USERNAME', 'epiz_29230064');
define('DB_PASSWORD', '2GkjODVBded');
define('DB_NAME', 'epiz_29230064_Ecomm');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>