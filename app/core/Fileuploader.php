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
        $targetFile = 'migrate/' . basename($tabel . '.sql');
        // if file exist
        if( file_exists($targetFile) ) {
            unlink($targetFile);
        }
        // if not php file
        $fn = $fileName;
        $ff = explode('.', $fn);
        $fr = end($ff); 
        if( $fr != 'sql' ) {
            $msg = 'File harus berupa file sql';
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

    // sql import 
    public function sqlImport($fileName) {
        global $db;
        $db->query("DROP TABLE product");
        $db->execute();
        $conn = mysqli_connect(HOST, USER, PASS, DB_NAME);

        $query = '';
        $sqlScript = file($fileName);
        foreach ($sqlScript as $line)	{
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
                
            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
                $query= '';		
            }
        }
    }

}