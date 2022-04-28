<?php 


class Fileuploader {

    function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    // image upload
    public function uploadImage($fileName, $fileType, $fileSize, $fileTmpName) {
        $msg = '';
        $status = false;
        $targetFile = 'assets/img/' . basename( $this->randomNumber(5) . '_' . $fileName);
        // check if this image file
        if( $fileType == 'image/png' || $fileType == 'image/jpeg' || $fileType == 'image/jpg' ){
            if ( $fileSize > 500000 ) {
                $msg = 'File size is too large';
                $status = false;
            } else {
                // move to target path
                if( move_uploaded_file($fileTmpName, $targetFile) ){
                    $msg = "The file ". htmlspecialchars( basename( $fileName )). " has been uploaded.";
                    $status = true;
                } else {
                    $status = false;
                    $msg = 'File gagal diupload';
                }
            }
        }

        return [
            'status' => $status,
            'message' => $msg,
            'to' => $targetFile
        ];
    }

    // database upload
    public function uploadDatabase($fileName, $fileType, $fileSize, $fileTmpName, $tabel) {
        $msg = '';
        $status = false;
        $targetFile = 'migrate/' . basename($tabel . '.php');
        // if file exist
        if( file_exists($targetFile) ) {
            unlink($targetFile);
        }
        // if not php file
        $fn = $fileName;
        $ff = explode('.', $fn);
        $fr = end($ff); 
        if( $fr != 'php' ) {
            $msg = 'File harus berupa file php';
            $status = false;
        }else {
            // check if this php file
            if( $fileType == 'application/octet-stream' ){
                if ( $fileSize > 500000 ) {
                    $msg = 'File size is too large';
                    $status = false;
                } else {
                    // move to target path
                    if( move_uploaded_file($fileTmpName, $targetFile) ){
                        $msg = "The file ". htmlspecialchars( basename( $fileName )). " has been uploaded.";
                        $status = true;
                    } else {
                        $status = false;
                        $msg = 'File gagal diupload';
                    }
                }
            }else {
                $msg = 'File type is not valid';
                $status = false;
            }
        }

        return [
            'status' => $status,
            'message' => $msg,
            'to' => $targetFile
        ];
    }

    // delete table product backup
    function deleteProduct(){
        $file = 'migrate/product.php';
        if( file_exists($file) ) {
            unlink($file);
        }
    }

}