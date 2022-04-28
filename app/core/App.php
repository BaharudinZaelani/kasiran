<?php 

class App {

    function __construct()
    {
        session_start();
    }
    
    public function auth($param) {
        $file = $_SERVER['SCRIPT_NAME'];
        $file = explode('/', $file);
        $file = end($file);
        if($param === "auth"){
            if( isset($_SESSION['admin']) ){
                if ( $file !== 'index.php' ) {
                    header("Location: " . BASE . 'index.php');
                }
            }else {
                header("Location: " . BASE . 'login.php');
            }
        }elseif($param === "login"){
            if( !isset($_SESSION['admin']) ){
                if ( $file !== 'login.php' ) {
                    header("Location: " . BASE . 'login.php');
                }
            }else {
                header("Location: " . BASE . 'index.php');
            }
        }
    }

    public function logout(){
        unset($_SESSION['admin']);
        session_destroy();
        header("Location: " . BASE . 'login.php');
    }

}