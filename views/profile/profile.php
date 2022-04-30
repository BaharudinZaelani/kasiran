<!-- php data -->
<?php 
$userController = new UserController();

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
    $app->redirect('/?key=profile-setting');
}
?>
<!-- scoped style -->
<style>

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
                        <h3>Info Log</h3>
                        <div class="hr"></div>
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
                <div class="row col-2">
                    <div>
                        <div class="input-group">
                            <label for="name"><b>Password Lama</b></label>
                            <input type="password" class="form-control" placeholder="Password Lama" id="old_password">
                        </div>
                    </div>
                    <div>
                        <div class="input-group">
                            <label for="name"><b>Password Baru</b></label>
                            <input type="password" class="form-control" placeholder="Password Baru" id="new_password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-submit mt-1">
                        <button class="primary">Ganti Password</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>