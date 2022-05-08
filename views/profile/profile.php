<!-- php data -->
<?php 
use Carbon\Carbon;
$userController = new UserController();
$userLog = new UserLogController();

// image change log
$imageLog = $userLog->logImage($_SESSION['admin']['id']);


// edit name
if( isset($_POST['gantiNama']) ) {
    $nama = $_POST['nama'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $userController->eidtVal($id, 'name', $nama, $password);
}else if( isset($_POST['gantiEmail']) ) {
    $email = $_POST['email'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $userController->eidtVal($id, 'email', $email, $password);
}else if( isset($_POST['gantiGambar']) ) {
    $file = new Fileuploader();
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $cek = $file->uploadImage($fileName, $fileType, $fileSize, $fileTmpName);
    $userController->eidtVal($_SESSION['admin']['id'], 'image', $cek['filename'], $_POST['password']);
    // add log
    $db->query('INSERT INTO user_log (user_id, action) VALUES (:user_id, :action)');
    $db->bind(':user_id', $_SESSION['admin']['id']);
    $db->bind(':action', 'Edit Profile Image:'.$cek['filename']);
    $db->execute();

    // refresh page
    $app->redirect('/?key=profile-setting');
}

// select image log
if( isset($_POST['select-image-log']) ){
    $image = $_POST['image-log'];
    $id = $_SESSION['admin']['id'];
    $db->query("UPDATE `user` SET `image` = '$image' WHERE `user`.`id` = $id;");
    $db->execute();
    $_SESSION['admin']['image'] = $image;
    $app->redirect('/?key=profile-setting');
}

// edit password
if( isset($_POST['edit-password']) ) {
    $id = $_SESSION['admin']['id'];
    $newPassword = $_POST['new_password'];
    $oldPassword = $_POST['old_password'];
    $ee = $userController->editPassword($id, $newPassword, $oldPassword);
}
?>
<!-- scoped style -->
<style>
    .log-image {
        display: flex;
        padding-bottom: 12px;
        margin-top: 6px;
    }
    .log-image img{
        width: 100px;
        height: 100px;
        margin-right: 12px;
    }
    .date {
        display: flex;
        align-items: center;
        padding: 5px 0;
    }
    .date svg {
        margin-right: 5px;
    }
    .alert {
        height: 310px;
        overflow-y: scroll;
    }
</style>
<!-- html -->
<div class="card-wrp">
    <form method="post" enctype="multipart/form-data">
    <input type="text" hidden name="password" value="<?= $_SESSION['admin']['password']; ?>">
    <input type="text" hidden name="id" value="<?= $_SESSION['admin']['id']; ?>">
        <!-- nama, avatar, email edit -->
        <div class="card">
            <div class="card-header">
                <h4><?= $_SESSION['admin']['name'] ?> - Setting</h4>
            </div>
            <div class="card-body">
                <div class="row col-2">
                    <div>
                        <div class="image-view">
                            <img src="<?= $_SESSION['admin']['image'] ?>">
                            <div class="sc text-center">
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control" hidden>
                                <button name="gantiGambar" class="btn">Submit Image</button>
                            </div>
                        </div>
                    </div>
                    <div class="alert">
                        <h3>Avatar Sebelumnya</h3>
                        <div class="hr"></div>
                        <div class="list">
                            <?php 
                            if( isset($imageLog) ) {
                                foreach ($imageLog as $key => $value) {
                                    $imageLogExplode = explode(':', $value['action']);
                                    $imageLogResult = end($imageLogExplode);
                                    $dt = Carbon::parse($value['updated_at']);
                                    ?>
                                    <div class="log-image">
                                        <img src="<?= $imageLogResult ?>">
                                        <div class="sc">
                                            <div class="time">
                                                <div class="date">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                    </svg>
                                                    <?= $dt->format('d M Y') ?>
                                                </div>
                                                <div class="date">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                                        <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                    </svg>
                                                    <?= $dt->format('H:i') ?>
                                                </div>
                                            </div>
                                            <div class="input-submit">
                                                <form method="post">
                                                    <input type="text" name="image-log" hidden value="<?= $imageLogResult?>">
                                                    <button name="select-image-log" class="btn">Select Image</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } 
                            }?>
                        </div>
                    </div>
                </div>
                <div class="row col-2">
                    <div>
                        <div class="input-group">
                            <label for="name"><b>Nama</b></label>
                            <input type="text" class="form-control" name="nama" placeholder="Name" id="name" value="<?= $_SESSION['admin']['name'] ?>">
                            <div class="input-submit mt-1">
                                <button name="gantiNama" class="primary">Ganti Nama</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="input-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" name="email" class="form-control" placeholder="Email" id="email" value="<?= $_SESSION['admin']['email'] ?>">
                            <div class="input-submit mt-1">
                                <button name="gantiEmail" class="primary">Ganti Email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- password edit -->
        <div class="card mt-1">
            <div class="card-header">
                <h4>Password</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row col-2">
                        <div>
                            <div class="input-group">
                                <label for="name"><b>Password Lama</b></label>
                                <input type="password" class="form-control" placeholder="Password Lama" id="old_password" name="old_password">
                            </div>
                        </div>
                        <div>
                            <div class="input-group">
                                <label for="name"><b>Password Baru</b></label>
                                <input type="password" class="form-control" placeholder="Password Baru" id="new_password" name="new_password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-submit mt-1">
                            <button class="primary" name="edit-password">Ganti Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
</div>