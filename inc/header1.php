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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mĩ phẩm OHUI</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
      integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css"
    />
    <link rel="stylesheet" href="./assets/css/base.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="stylesheet" href="./cart.css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>
  <body>
    <div class="container">
      <header class="header">
        <div class="grid wide">
          <nav class="navbar1">
            <ul class="navbar__list">
              <li class="navbar__list-item separate"><a href="./introduce.php" class="gt_hui">Giới thiệu về OHUI</a></li>
              <li class="navbar__list-item separate header__hover--download">
                Tải ứng dụng
                <div class="header__QR">
                  <img
                    src="./assets/img/QR.png"
                    alt="QR Code"
                    class="header__img--QR"
                  />
                  <div class="header__download">
                    <a href="" class="header__download--link">
                      <img
                        src="./assets/img/ad.png"
                        alt="download"
                        class="link__download"
                      />
                    </a>
                    <a href="" class="header__download--link">
                      <img
                        src="./assets/img/ad1.png"
                        alt="download"
                        class="link__download"
                      />
                    </a>
                    <a href="" class="header__download--link">
                      <img
                        src="./assets/img/ad2.png"
                        alt="download"
                        class="link__download"
                      />
                    </a>
                  </div>
                </div>
              </li>
              <li class="navbar__list-item">
                <span class="item__nohover">Kết nối</span>
                <a href="https://www.facebook.com/bam.nguien" class="navbar__link-icon">
                    <i class="navbar_link-icon-child fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com" class="navbar__link-icon">
                    <i class="navbar_link-icon-child fab fa-instagram"></i>
                </a>
            </li>
            </ul>

            <ul class="navbar__list">
              <li class="navbar__list-item">
                <a href="./help.php" class="navbar__link">
                  <i class="navbar_link-icon-child far fa-question-circle"></i>
                  Trợ giúp
                </a>
              </li>
              <?php
       if(isset($_GET['customer_id'])){
                                    Session::destroy();
                                }
                       ?>
                            <?php
                            $login_check = Session::get('customer_login');
                            if($login_check==false){
                                echo'<li class="navbar__list-item bold separate"><a href="register.php" class="register">Đăng ký</a></li>
                                <li class="navbar__list-item bold"><a href="login.php" class="login">Đăng nhập</a></li>';
                            }else{
                              $id = Session::get('customer_id');
                              $get_customers = $cs->show_customers($id);
                              if($get_customers){
                              while($result = $get_customers->fetch_assoc()){
                              echo' <li class="navbar__list-item navbar__list-user">
                              <span class="navbar__list-user-name">'.$result['fname'].' '.$result['lname'].'</span>
  
                              <ul class="navbar__list-user-menu">
                                  <li class="navbar__list-user-item">
                                      <a href="profile.php">Tài khoản của tôi</a>
                                  </li>
                                  <li class="navbar__list-user-item">
                                      <a href="success.php">Đơn mua</a>
                                  </li>
                                  <li class="navbar__list-user-item">
                                    <a href="historyBuy.php">Đơn hàng đã mua</a>
                                </li>
                                  <li class="navbar__list-user-item">
                                      <a  href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a>
                                  </li>
                              </ul>
                          </li>';
                          }}}
                            ?>
            </ul>
          </nav>
          <div class="header__logo" style="margin-top: 10px;">
            <a href="./index.php" class="header__logo-link">
            <img src="./assets/img/logo.png" alt="" width="140px">
            </a>
            <div class="header__logo_text">Giỏ Hàng</div>
          </div>
        </div>
      </header>
    </div>