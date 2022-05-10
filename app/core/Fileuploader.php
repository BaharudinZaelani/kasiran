<?php

use Carbon\Carbon;

class Fileuploader {

    function randomNumber($length) {
        $result = '';
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function getTimeNow() {
        $time = Carbon::now();
        $time = $time->format('Y-m-d');
        return $time;
    }

    // image upload
    public function uploadImage($fileName, $fileType, $fileSize, $fileTmpName) {
        $msg = '';
        $status = false;
        $randomFilename = $this->randomNumber(5) . '_' . $fileName;
        $targetFile = 'assets/img/' . basename( $randomFilename );
        // check if this image file
        if( $fileType == 'image/png' || $fileType == 'image/jpeg' || $fileType == 'image/webp' ){
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
            'to' => $targetFile,
            'filename' => $targetFile
        ];
    }

    // database upload
    public function uploadDatabase($fileName, $fileType, $fileSize, $fileTmpName, $tabel) {
        $msg = '';
        $status = false;
        $targetFile = 'migrate/' . basename($tabel . '.ksr');
        // if file exist
        if( file_exists($targetFile) ) {
            unlink($targetFile);
        }
        // if not ksr file
        $fn = $fileName;
        $ff = explode('.', $fn);
        $fr = end($ff); 
        if( $fr != 'ksr' ) {
            $msg = 'File harus berupa file ksr';
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
    function deleteProduct($file){
        if( file_exists($file) ) {
            unlink($file);
        }

        echo '<script>alert("File berhasil dihapus");</script>';
    }

    // sql import 
    public function sqlImport($fileName) {
        global $db;
        $sqlScript = file($fileName);
        foreach ($sqlScript as $line) {
            $endWith = substr_replace($line ,"", -1);
            try{
                $db->query($endWith);
                $db->execute();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function createDataBackup($table){ 
        global $db;
        $baseQuery = "INSERT INTO `product` (`id`, `name`, `image`, `type`, `category`, `quantity`, `first_quantity`, `tax`, `cost`, `price`, `discount`, `created_at`, `updated_at`) VALUES ";
        $query = $db->query("SELECT * FROM `$table`");
        $data = $db->resultSet();

        $tmpQuery = '';
        foreach ($data as $key => $value) {
            $tmpQuery .= "(NULL, '".$value['name']."', '".$value['image']."', '".$value['type']."', '".$value['category']."', '".$value['quantity']."', '".$value['first_quantity']."',  '".$value['tax']."', '".$value['cost']."', '".$value['price']."', '".$value['discount']."', '".$value['created_at']."', '".$value['updated_at']."'),";
        }
        $fn = $this->getTimeNow() . '_' . $table . '.ksr';
        $fileBP = 'dl/backup/'. $fn;
        $cFile = fopen($fileBP, 'w') or die("Unable to open file!");
        fwrite($cFile, $baseQuery.$tmpQuery);
        fclose($cFile);

        return $fn;
    }

    public function download($to = "", $file = ""){
        $uri =  BASE . '/download.php' . "?dl=$to&file=$file";
        echo '
            <script>
                window.open("'. $uri .'");
            </script>
        ';
    }

}