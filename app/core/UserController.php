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
            }

            if( password_verify($pw, $admin['password']) ) {
                return true;
            }

            return false;
        }
    }
    
    public function eidtVal($baris, $kolom, $data, $pw){
        global $db;
        $err = true;
        $msg = 'Error mungkin dari aplikasinya :(, silahkan hubungi @Baharudin Zaelani';
        if( $this->adminCheck($pw, $baris) ){
            // update user name
            $query = "UPDATE `user` SET `$kolom` = '$data' WHERE `user`.`id` = $baris;";
            $db->query($query);
            $db->execute();


            // action log
            if( $kolom == 'name' ){
                $id = $_SESSION['admin']['id'];
                $db->query("UPDATE `action_log` SET `user` = '$data' WHERE `action_log`.`user_id` = $id;");
                $db->execute();
            }
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

    public function editPassword($id, $newPassword, $oldPassword){
        global $db;
        $err = true;
        $msg = 'Password gagal diubah';
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        if( $this->adminCheck($oldPassword, $id) ){
            $query = "UPDATE `user` SET `password` = '$newPassword' WHERE `user`.`id` = $id;";
            $db->query($query);
            $db->execute();

            // edit session
            $_SESSION['admin']['password'] = $newPassword;

            $err = false;
            $msg = 'Login kembali dengan password baru';
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

        return ['err' => $err, 'msg' => $msg];
    }
}