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
define("SERVER", $uri);
define("BASE", "http://" . $uri); 

// Database Config
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB_NAME", "kasiran");

define("NAME", "KASIRAN");

// aplication color
$curent = "dark";
if( $curent == "dark" ){
    define("SIDE_COLOR", "#fff");
    define("BG_COLOR", "#1c1c1c");
    define("BG_COLOR_SECOND", "#515151");
    define("BG_COLOR_THIRD", "#1c1c1c80");
    define("BG_COLOR_FOURTH", "#4a4949");
}else if( $curent == "pink" ){
    define("SIDE_COLOR", "#000");
    define("BG_COLOR", "#F2789F");
    define("BG_COLOR_SECOND", "#F999B7");
    define("BG_COLOR_THIRD", "#F9C5D5");
    define("BG_COLOR_FOURTH", "#FEE3EC");
}else if( $curent == "teahijau" ){
    define("SIDE_COLOR", "#000");
    define("BG_COLOR", "#535A3B");
    define("BG_COLOR_SECOND", "#A7B99E");
    define("BG_COLOR_THIRD", "#CEDCC3");
    define("BG_COLOR_FOURTH", "#EFF7D3");
}