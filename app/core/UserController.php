<?php 

class UserController{

    public function adminCheck($pw, $id){
        global $db;
        $queryAdmin = "SELECT * FROM `user` WHERE `id` = '". $id . "'";
        $db->query($queryAdmin);
        $admin = $db->single();
        if( $admin ){
            if( $pw === $admin['password']) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function eidtVal($baris, $kolom, $data, $pw){
        global $db;
        $err = true;
        $msg = '';
        if( $this->adminCheck($pw, $baris) ){
            $query = "UPDATE `user` SET `$kolom` = '$data' WHERE `user`.`id` = $baris;";
            $db->query($query);
            $db->execute();
            if ( $db->rowCount() > 0 ) {
                $err = false;
                $msg = $kolom . ' berhasil diubah';
                $_SESSION['admin'][$kolom] = $data;
            } else {
                $err = true;
                $msg = $kolom . ' gagal diubah';
            }
        }
        echo '<script>
                Swal.fire({
                    title: "'. NAME .' Says !",
                    text: "' . $msg . '",
                    icon: "' . ($err ? 'error' : 'success') . '",
                    confirmButtonText: "OKE !",
                    confirmButtonColor: "'. ($err ? '#e74a3b' : '#2b982b') .'"
                })
            </script>
        ';
    }
}