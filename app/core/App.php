<?php 
class App {

    function __construct()
    {
        session_start();
        new DateTimeZone('Asia/Jakarta');
    }

    public function getURI(){
        $file = $_SERVER['SCRIPT_NAME'];
        $file = explode('/', $file);
        $file = end($file);
        return $file;
    }
    
    public function auth($param) {
        $file = $this->getURI();
        if($param === "auth"){
            if( isset($_SESSION['admin']) ){
                if ( $file !== 'index.php' ) {
                    header("Location: " . '/index.php');
                    exit;
                }
            }else {
                header("Location: " . '/login.php');
                exit;
            }
        }elseif($param === "login"){
            if( !isset($_SESSION['admin']) ){
                if ( $file !== 'login.php' ) {
                    header("Location: " . '/login.php');
                    exit;
                }
            }else {
                header("Location: " . '/index.php');
                exit;
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

    public function redirect($to = ""){
        echo '<script>location.href = "' . BASE . $to . '"</script>';
    }

    public function actionLog($user_id, $user, $action, $time){
        global $db;
        $query = "INSERT INTO action_log (user_id, user, action, created_at) VALUES ('$user_id', '$user', '$action', '$time')";
        $db->query($query);
        $db->execute();
    }


}