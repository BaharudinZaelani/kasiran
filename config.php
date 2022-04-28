<?php 
/* 
 * base = http://localhost:8080/kasiran (project name)
 * base = http://localhost/kasiran (project name)
 * $_SERVER['HTTP_HOST'] . '/kasiran/'
*/
$uri = '';
if( isset($_SERVER['REQUEST_SCHEME']) ){
    $uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
}else {
    $uri = '127.0.0.1:3000'; // or localhost:3000
}

define("BASE", $uri); 

// Database Config
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB_NAME", "kasir_one");

define("NAME", "KASIRAN");