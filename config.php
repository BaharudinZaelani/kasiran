<?php 
/* --------------------------------------------------------------------
 * Jangan mengubah kode-kode di bawah ini ya!, jika anda tidak mengerti 
 * --------------------------------------------------------------------
 
 * base = http://localhost:8080/kasiran (project name)
 * base = http://localhost/kasiran (project name)
 * $_SERVER['HTTP_HOST'] . '/kasiran/'
*/
if( isset($_SERVER['REQUEST_SCHEME']) ){
    $uri = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
}else {
    $uri = '127.0.0.1:3000'; // or localhost:8000
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
define('LOGO', '/assets/img/logo.png');
define('LOGO_WEB', '/assets/img/logo_web.png');
define('TIMEZONE', 'Asia/Jakarta');
$curent = "teahijau";
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
}else if( $curent == "custom" ){
    define("SIDE_COLOR", "#fff"); // custom
    define("BG_COLOR", "#00A0BD"); // custom
    define("BG_COLOR_SECOND", "#00CDDB"); // custom
    define("BG_COLOR_THIRD", "#00A0BD"); // custom
    define("BG_COLOR_FOURTH", "#1C585C"); // custom
}

// product config
$show = 10;
$page = 1;
define("PRODUCT_SHOW", $show);
define("PRODUCT_PAGE", $page);