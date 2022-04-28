<?php include 'app/init.php'; ?>
<?php 
$database = new Database();
$app = new App();
$app->auth('login');
$error = false;

// echo password_hash('admin', PASSWORD_DEFAULT);


if( isset($_POST['login']) ) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $getAdmin = "SELECT * FROM `user` WHERE `username` = '". $username . "'";
    $database->query($getAdmin);
    $admin = $database->single();
    if( $admin ){
        if( password_verify($password, $admin['password']) ){
            $_SESSION['admin'] = $admin;
            header('Location: index.php');
        } else {
            $error = true;
        }
    }else {
        $error = true;
    }
}

?>
<?php include 'views/header.php'; ?>
<style>   
    /* login style */
    .login-wrp {
        height: 100vh;
        width: 100vw;
        overflow: hidden;
        display: grid;
        justify-content: center;
        align-items: center;
    }
    .login-card {
        padding: 20px;
        width: 40vw;
        height: 60%;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        border-radius: 12px;
        position: relative;
        background-color: #fff;
    }
    .login-header {
        text-align: center;
        border-bottom: 1px solid rgba(128, 128, 128, 0.288);
        width: 100%;
        /* height: 70px; */
        padding-bottom: 22px;
    }
    .login-body {
        display: grid;
        background-color: #fff;
        height: 40%;
    }
    .login-footer {
        padding: 20px;
        display: grid;
        align-items: center;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50px;
        text-align: center;
    }

    /* input style */
    .input-group {
        width: 90%;
        margin: 0 auto;
    }
    .input-group .label {
        margin-bottom: 12px;
    }
    .input-group .input {
        margin: 12px 0 ;
    }
    .input-group input {
        width: 98%;
        border-radius: 12px;
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 14px;
        outline: none;
    }
    .input-submit {
        margin: 29px 0;
        display: grid;
        justify-content: flex-start;
    }
    .input-submit button {
        opacity: 0.7;
        cursor: pointer;
        padding: 12px 22px;
        border: 0;
        border-radius: 12px;
    }
    .input-submit button:hover {
        opacity: 1;
    }
    .input-submit button.primary {
        background-color: #00a8ff;
        color: #fff;
    }
    .error {
        border-radius: 12px;
        display: inline-block;
        background-color: rgb(255, 112, 112);
        color: #fff;
        padding: 9px 52px;
        margin: 12px 0 0 0;
    }



    /* mobile device */
    @media screen and (max-width: 768px) {
        .login-wrp {
            justify-content: normal;
            padding: 12px;
            height: 100vh;
            overflow: hidden;
        }
        .login-card {
            width: auto;
        }
    }
</style>
<div class="login-wrp">
    <div class="login-card">
        <div class="login-header">
            <h1><?= NAME; ?> - Login</h1>
            <?php if($error) : ?>
                <div class="error">
                    <span>Invalid username or password</span>
                </div>
            <?php endif;?>
        </div>
        <div class="login-body">
            <form method="post">
                <div class="input-group">
                    <!-- username -->
                    <div class="input">
                        <div class="label">    
                            <label for="username">Username</label>
                        </div>
                        <input type="text" name="username" id="username" placeholder="...">
                    </div>
                    <!-- password -->
                    <div class="input">
                        <div class="label">    
                            <label for="password">Password</label>
                        </div>
                        <input type="password" name="password" id="password" placeholder="...">
                    </div>
    
                    <!-- submit button -->
                    <div class="input-submit">
                        <button class="primary" name="login">
                            LOGIN
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <div class="login-footer">
            <span>@2022 Kasiran</span>
        </div>
    </div>
</div>


<?php include 'views/footer.php'; ?>