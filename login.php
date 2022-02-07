<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OHUI - Login</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin/css/fix.css" rel="stylesheet">

</head>
<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
    include 'lib/database.php';
    include 'heplers/format.php';

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cs = new customer();
    $cat = new category();
    $product = new product();
?>
<?php
     $login_check = Session::get('customer_login');
     if($login_check){
        header('Location:index.php');
     }
?>

<?php
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

         $login_Customer = $cs->login_customer($_POST);
     }
?>
<body class="bg-gradient-primary">
    <div class="hd-login">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="hd-login_left d-flex align-items-center">
                <div class="hd-login_left_img">
                    <a href="index.php">
                        <img src="assets/img/logo.png" alt="" width="100%">
                    </a>
                </div>
                <span style="margin-left: 14px; font-size: 2rem" >Đăng nhập</span>
            </div>
            <div class="hd-login_right">
                <a href="help.php" style="text-decoration: none; color: white"><span>Cần trợ giúp?</span></a>
            </div>
        </div>
    </div>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                if(isset($login_Customer)){
                                    echo $login_Customer;   
                                }
                            ?>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="account" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập tài khoản..." >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Nhập mật khẩu..." >
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="login" class="btn btn-primary btn-user btn-block" value="Đăng nhập"/>
                                       
                                    </form>
                                    <hr>
                                   
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>

</body>

</html>