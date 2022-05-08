<?php 
if( isset($_GET['dl']) ){
    $key = $_GET['dl'];
    $filepath = $_GET['file'];
    if( $key == 'download-excel'){
        $filepath = 'dl/product/' . $_GET['file'];
    }else if($key == 'download-ksr'){
        $filepath = 'dl/backup/' . $_GET['file'];
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download <?= $_GET['dl']?></title>
</head>
<body>

<h1>Harap Tunggu</h1>
    
</body>
</html>