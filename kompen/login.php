<?php
    session_start();
        if (isset($_SESSION['location'])) {
            echo "<script>alert('Anda Sudah Login'); location.href='" . $_SESSION["location"] . "';</script>";
            exit();
        }

    include 'classes/databases.php';
    include 'classes/auth.php';
    $db = new Database();
    $auth = new Auth($db);
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $auth->login($username, $password);
        if ($user) {
            $role = $user['role'];
            $_SESSION['role'] = $role;
            $_SESSION['data'] = $user['data'];
            $_SESSION['location'] = $user['location'];
            switch ($role) {
                case 'dosen':
                    echo "<script>alert('" . $user["message"] . "'); location.href='" . $user["location"] . "';</script>";
                    break;
                case 'mahasiswa':
                    echo "<script>alert('" . $user["message"] . "'); location.href='" . $user["location"] . "';</script>";
                    break;
            }
            exit;
        } else {
            echo "<script>alert('Login Gagal');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Open+Sans:300,400,600,700"]
            },
            custom: {
                families: ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['../assets/css/fonts.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/azzara.min.css">
</head>
<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sign In To Admin</h3>
            <form method="POST">
                <div class="login-form">
                    <div class="form-group">
                        <label for="username" class="placeholder"><b>Username</b></label>
                        <input id="username" name="username" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="placeholder"><b>Password</b></label>
                        <div class="position-relative">
                            <input id="password" name="password" type="password" class="form-control" required>
                            <div class="show-password">
                                <i class="flaticon-interface"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-action-d-flex justify-content-center mb-3">
                        <button type="submit" name="login"
                            class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/js/core/bootstrap.min.js"></script>
</body>

</html>