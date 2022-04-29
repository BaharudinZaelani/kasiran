<!-- php data -->
<?php 
$file = 'config.php';
// ambil semua content
$content = file_get_contents($file);
if(strpos($content, 'define("SIDE_COLOR", "side-color"); // custom') !== false){
    file_put_contents($file,str_replace('define("SIDE_COLOR", "side-color"); // custom','define("SIDE_COLOR", "side-colors"); // custom',file_get_contents($file)));
}
// custom color
if( isset($_POST['submit-theme']) ){
    $side = $_POST['side-color'];
    $tmpSide = 'define("SIDE_COLOR", "' . $side .'"); // custom';
    $bg_color = $_POST['bg-color'];
    $tmpBg = 'define("BG_COLOR", "' . $bg_color .'"); // custom';
    $bg_color_second = $_POST['bg-color-second'];
    $tmpBgSecond = 'define("BG_COLOR_SECOND", "' . $bg_color_second .'"); // custom';
    $bg_color_third = $_POST['bg-color-third'];
    $tmpBgThird = 'define("BG_COLOR_THIRD", "' . $bg_color_third .'"); // custom';
    $bg_color_fourth = $_POST['bg-color-fourth'];
    $tmpBgFourth = 'define("BG_COLOR_FOURTH", "' . $bg_color_fourth .'"); // custom';

    // edit custom color
    // side color
    $cc = 'define("SIDE_COLOR", "'. SIDE_COLOR .'"); // custom';
    if( strpos($content, $cc) !== false ){
        file_put_contents($file,str_replace($cc, $tmpSide, file_get_contents($file)));
    }

    $cc = 'define("BG_COLOR", "'. BG_COLOR .'"); // custom';
    if( strpos($content, $cc) !== false ){
        file_put_contents($file,str_replace($cc, $tmpBg, file_get_contents($file)));
    }

    $cc = 'define("BG_COLOR_SECOND", "'. BG_COLOR_SECOND .'"); // custom';
    if( strpos($content, $cc) !== false ){
        file_put_contents($file,str_replace($cc, $tmpBgSecond, file_get_contents($file)));
    }

    $cc = 'define("BG_COLOR_THIRD", "'. BG_COLOR_THIRD .'"); // custom';
    if( strpos($content, $cc) !== false ){
        file_put_contents($file,str_replace($cc, $tmpBgThird, file_get_contents($file)));
    }

    $cc = 'define("BG_COLOR_FOURTH", "'. BG_COLOR_FOURTH .'"); // custom';
    if( strpos($content, $cc) !== false ){
        file_put_contents($file,str_replace($cc, $tmpBgFourth, file_get_contents($file)));
    }

    // edit curent variabel
    if ( strpos($content, '$curent = "pink";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pink";','$curent = "custom";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "custom";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "teahijau";') !== false ) {
        file_put_contents($file,str_replace('$curent = "teahijau";','$curent = "custom";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "dark";') !== false ) {
        file_put_contents($file,str_replace('$curent = "dark";','$curent = "custom";',file_get_contents($file)));
    }
    echo '<script>location.href = "' . BASE . '?tools=theme"</script>';
}

// theme
if( isset($_POST['dark']) ) {
    if ( strpos($content, '$curent = "pink";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pink";','$curent = "dark";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "dark";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "teahijau";') !== false ) {
        file_put_contents($file,str_replace('$curent = "teahijau";','$curent = "dark";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "custom";') !== false ) {
        file_put_contents($file,str_replace('$curent = "custom";','$curent = "dark";',file_get_contents($file)));
    }
    echo '<script>location.href = "' . BASE . '?tools=theme"</script>';

}else if( isset($_POST['pink']) ) {
    if ( strpos($content, '$curent = "dark";') !== false ) {
        file_put_contents($file,str_replace('$curent = "dark";','$curent = "pink";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "pink";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "teahijau";') !== false ) {
        file_put_contents($file,str_replace('$curent = "teahijau";','$curent = "pink";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "custom";') !== false ) {
        file_put_contents($file,str_replace('$curent = "custom";','$curent = "pink";',file_get_contents($file)));
    }
    echo '<script>location.href = "' . BASE . '?tools=theme"</script>';

}else if( isset($_POST['teahijau']) ) {
    if ( strpos($content, '$curent = "dark";') !== false ) {
        file_put_contents($file,str_replace('$curent = "dark";','$curent = "teahijau";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pastel";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pastel";','$curent = "teahijau";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "pink";') !== false ) {
        file_put_contents($file,str_replace('$curent = "pink";','$curent = "teahijau";',file_get_contents($file)));
    }else if ( strpos($content, '$curent = "custom";') !== false ) {
        file_put_contents($file,str_replace('$curent = "custom";','$curent = "teahijau";',file_get_contents($file)));
    }
    echo '<script>location.href = "' . BASE . '?tools=theme"</script>';

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
        <div class="card-body">
            <form method="post">
                <!-- SIDE_COLOR , BG_COLOR -->
                <div class="row col-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Text Color</span>
                        </div>
                        <input type="text" class="form-control" name="side-color" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="side-color" 
                        value="<?= SIDE_COLOR; ?>">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Background Color</span>
                        </div>
                        <input type="text" class="form-control" name="bg-color" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="bg-color" 
                        value="<?= BG_COLOR; ?>">
                    </div>
                </div>

                <!-- BG_COLOR_SECOND, BG_COLOR_THIRD -->
                <div class="row col-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">BG_COLOR_SECOND</span>
                        </div>
                        <input type="text" name="bg-color-second" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="bg-color-second" 
                        value="<?= BG_COLOR_SECOND; ?>">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">BG_COLOR_THIRD</span>
                        </div>
                        <input type="text" name="bg-color-third" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="bg-color-third" 
                        value="<?= BG_COLOR_THIRD; ?>">
                    </div>
                </div>

                <!-- BG_COLOR_FOURTH -->
                <div class="row col-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">BG_COLOR_FOURTH</span>
                        </div>
                        <input name="bg-color-fourth" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="bg-color-fourth" 
                        value="<?= BG_COLOR_FOURTH; ?>">
                    </div>
                </div>

                <!-- submit -->
                <div class="row col-2">
                    <div class="input-submit">
                        <button style="background-color: <?= BG_COLOR; ?> !important;" name="submit-theme">Ubah Tema</button>
                    </div>
                </div>
            </form>
        </div>
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