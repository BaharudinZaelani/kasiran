<!-- php data -->
<?php 
$file = 'config.php';
// ambil semua content
$content = file_get_contents($file);

// dark theme
if( isset($_POST['dark']) ) {
    if ( strpos($content, '$curent = "pink";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pink";','$curent = "dark";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "dark";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "teahijau";') !== false ) {
        file_put_contents($file,str_replace('$curent = "teahijau";','$curent = "dark";',file_get_contents($file)));
    }
}else if( isset($_POST['pink']) ) {
    if ( strpos($content, '$curent = "dark";') !== false ) {
        file_put_contents($file,str_replace('$curent = "dark";','$curent = "pink";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "pink";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "teahijau";') !== false ) {
        file_put_contents($file,str_replace('$curent = "teahijau";','$curent = "pink";',file_get_contents($file)));
    }
}else if( isset($_POST['teahijau']) ) {
    if ( strpos($content, '$curent = "dark";') !== false ) {
        file_put_contents($file,str_replace('$curent = "dark";','$curent = "teahijau";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "teahijau";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pink";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pink";','$curent = "teahijau";',file_get_contents($file)));
    }
}
?>
<!-- scoped style -->
<style>

</style>
<!-- html -->
<div class="card-wrp">
    <div class="card">
        <div class="card-header">
            <h4>Custom Color</h4>
        </div>
        <div class="card-body"></div>
    </div>
</div>

<div class="card-wrp mt-1">
    <div class="card">
        <div class="card-header">
            <h4>Theme</h4>
        </div>
        <div class="card-body">
            <div class="input-submit">
                <form method="post">
                    <button name="dark" style="background-color: #1c1c1c !important;"></button>
                    <button name="pink" style="background-color: #F2789F !important;"></button>
                    <button name="teahijau" style="background-color: #535A3B !important;"></button>
                </form>
            </div>
        </div>
    </div>
</div>