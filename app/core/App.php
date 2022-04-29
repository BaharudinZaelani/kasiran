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
                    header("Location: " . '/index.php');
                }
            }else {
                header("Location: " . '/login.php');
            }
        }elseif($param === "login"){
            if( !isset($_SESSION['admin']) ){
                if ( $file !== 'login.php' ) {
                    header("Location: " . '/login.php');
                }
            }else {
                header("Location: " . '/index.php');
            }
        }
    }

    public function logout(){
        unset($_SESSION['admin']);
        session_destroy();
        header("Location: /login.php");
    }

    public function forAdmin(){
        if( $_SESSION['admin']['role'] == 'Kasir' ){
            echo '<script>location.href = "' . BASE . '"</script>';
        }
    }

}