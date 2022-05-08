<?php 

include 'app/init.php';

$app = new App();
$db = new Database();
$p = new Produk();

$app->auth('auth');


if( isset($_POST['logout']) ){
    $app->logout();
    $app->redirect('login.php');
}
include 'views/header.php'; 
?>
<style>
    .wrp{
        height: 100vh !important;
        overflow: hidden !important;
        width: 100vw !important;
        background-color: <?= BG_COLOR_FOURTH; ?> !important;
    }
</style>
<div class="container">
    <div class="col-sidebar">
        <div class="side-header">
            <!-- <h3><?= NAME; ?></h3> -->
            <img src="<?= BASE . LOGO ?>" width="140" alt="">
        </div>
        <div class="side-body">
            <div class="list-nav">
                <ul>
                    <li class="list-item">
                        <a class="title" href="<?= BASE . '/pos.php'; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                            </svg>
                            POS
                        </a> 
                    </li>
                    <li class="list-item">
                        <a class="title text-light" href="<?= BASE; ?>/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                                <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                            </svg>
                            DASHBOARD
                        </a> 
                    </li>
                    <div class="hr"></div>
                    <?php if( $_SESSION['admin']['role'] == 'Admin' ) : ?>
                        <li class="list-item">
                            <div class="dropdown">
                                <div class="title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    KASIR 
                                </div> 
                                <div class="sub-nav hide">
                                    <ul>
                                        <li><a href="?tools=user-list" class="text-light">List Kasir</a></li>
                                        <li><a href="?tools=user-add" class="text-light">Tambah Kasir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="list-item">
                        <div class="dropdown">
                            <div class="title">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg> 
                                PRODUK
                            </div> 
                            <div class="sub-nav hide">
                                <ul>
                                    <li><a href="?tools=product-list" class="text-light">List Products</a></li>
                                    <li><a href="?tools=product-add" class="text-light">Tambah Products</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php if( $_SESSION['admin']['role'] == 'Admin' ) : ?>
                        <li class="list-item">
                            <div class="dropdown">
                                <div class="title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                    </svg>
                                    Utilities
                                </div> 
                                <div class="sub-nav hide">
                                    <ul>
                                        <li>
                                            <a href="?tools=import" class="text-light">Import Tabel</a>
                                        </li>
                                        <li>
                                            <a href="?tools=theme" class="text-light">Tema Web</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <div class="side-footer">
            <span>@2020 <?= NAME; ?></span>
        </div>
    </div>
    <div class="col-content">
        <div class="navbar">
            <div class="user" id="nav-dropdown">
                <div class="head">
                    <img class="rounded" src="<?= $_SESSION['admin']['image']; ?>" width="30" height="30">
                    <div class="username">
                        <?php if( isset($_SESSION['admin']) ) : ?>
                            <span style="color: <?= SIDE_COLOR; ?>;"><?= $_SESSION['admin']['email']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="sub-navbar hide">
                    <div class="sub-navbar-header">
                        <div class="sub-navbar-title">
                            <div class="avatar">
                                <img class="rounded" src="<?= $_SESSION['admin']['image']; ?>" width="80" height="80">
                            </div>
                            <div class="sub-nav-title">
                                <?php if( isset($_SESSION['admin']) ) : ?>
                                    <h3 style="color: <?= SIDE_COLOR; ?>;"><?= $_SESSION['admin']['name']?></h3>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-footer">
                        <div>
                            <a href="?key=profile-setting" class="primary">setting</a>
                        </div>
                        <div>
                            <form method="post">
                                <button name="logout" class="danger">logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content scroll">
            <?php if (isset($_GET['tools']))  { 
                // product
                if($_GET['tools'] == 'product-list'){
                    include 'views/products/list_product.php';
                }  
                else if($_GET['tools'] == 'product-add'){
                    include 'views/products/add_product.php';
                }

                // utilites
                else if($_GET['tools'] == 'import'){
                    include 'views/tools/import.php';
                }
                else if($_GET['tools'] == 'theme'){
                    include 'views/tools/theme.php';
                }else {
                    $app->redirect();
                }

                
            }else if(isset($_GET['key'])) {
                // profile-setting
                if ($_GET['key'] == 'profile-setting') {
                    include 'views/profile/profile.php';
                }else {
                    $app->redirect();
                }
            } else {
                include 'views/dashboard.php';
            }?>
        </div>
    </div>
</div>


<?php include 'views/footer.php'; ?>