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
    
    // if(isset($_POST['submit'])){
    //     $text_his = $_POST['timkiem'];
    //     $searchProduct = $product->searchProduct($text_his);
    // }
?>

<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8"> <!--  viet unicode -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--cài đặt cho màn hình hiện thị bằng chính chiều dài của màn hình đó, độ thu phóng 100% -->
    <title>Mĩ phẩm OHUI</title>
    <!--[if lte IE 9]>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>    
    <![endif]-->
    <!-- 
        Breakpoints là điểm/vị trí mà bố cục website sẽ thay đổi - thích ứng để tạo nên giao diện responsive
        Mobile: width < 740px 
        Tablet: width >= 740px nd width < 1024px 
        PC: width >= 1024px
    -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./product.css" />
    <link rel="stylesheet" href="./ft_style.css"/>
    <link rel="stylesheet" href="./admin/css/fix.css"/>
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid wide">
               <nav  class="navbar1">
                    <ul class="navbar__list">
                        <li class="navbar__list-item separate"><a href="./introduce.php" class="gt_hui">Giới thiệu về OHUI</a></li>
                        <li class="navbar__list-item separate header__hover--download">
                            Tải ứng dụng
                            <div class="header__QR ">
                                <img src="./assets/img/QR.png" alt="QR Code" class="header__img--QR">
                                <div class="header__download">
                                    <a href="" class="header__download--link">
                                        <img src="./assets/img/ad.png" alt="download" class="link__download">
                                    </a>
                                    <a href="" class="header__download--link">
                                        <img src="./assets/img/ad1.png" alt="download" class="link__download">
                                    </a>
                                    <a href="" class="header__download--link" style="margin-top: 5px;"> 
                                        <img src="./assets/img/ad2.png" alt="download" class="link__download">
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
                                $delCart = $ct->del_all_data_cart();
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
                                    <a href=" ?customer_id='.Session::get('customer_id').'">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>';
                        }}}
                        ?>
                    </ul>
                </nav>
                <!-- Header with search -->
                <div class="header-with-search">
                    <div class="header__logo"> 
                        <a href="index.php" class="header__logo-link">
                        <img src="./assets/img/logo.png" alt="" width="140px">
                        </a>
                    </div>
                    <form action="index.php?search=timkiem" class="header__search" method="POST">
                        <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" name="timkiem" placeholder="Tìm kiếm sản phẩm" autocomplete="off">

                            <!-- search history -->
                            <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <?php
                                        $get_history = $product->get_history();
                                        if($get_history){
                                        while($result = $get_history->fetch_assoc()){
                                    ?>
                                    <li class="header__search-history-items">
                                        <a href="index.php?timkiemm=<?php echo $result['text_history']?>" class="header__search-history-item">
                                            <span><?php echo $result['text_history'] ?></span>  
                                        </a>
                                    </li>
                                    <?php }} ?>
                                </ul>
                            </div>
                        </div>
                        <div class="header__search-select">
                            <span class="header__search-select-label" >OHUI Shop</span>
                        </div>
                        <button class="header__search-btn" type="submit" name="submit">
                            <i class="fas header__search-btn-icon fa-search"></i>
                        </button>
                    </div> 
                    </form>

                    <div class="header__cart">
                        
                            <div class="header__cart-wrap" >
                                <a href="./cartIndex.php">
                                <i class=" header__cart-icon fas fa-cart-plus"></i>
                                <?php
                                    $qty = Session::get("qty");
                                    $i = 0;
                                    if($qty<1 ){ 
                                        
                                ?>
                                <!-- NO cart header__cart-list-empty -->
                                <div class="header__cart-list">
                                        <img src="assets/img/no_cart.png" alt="" class="header__cart-list-img">
                                        <div class="header__cart-list-text">
                                            Chưa có sản phẩm
                                        </div>
                                </div>
                                <?php
                                    }else{ 
                                    
                                ?>
                                <span class="header__cart-notify"><span class="header__cart-notify_num"><?php echo $qty?></span></span>
                                <div class="header__cart-list">
                                    <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                    <ul class="header__cart-list-item">
                                        <!-- Cart item -->
                                        <?php
                                            $get_product_cart = $ct->get_product_cart();
                                            if($get_product_cart){
                                            while($result = $get_product_cart->fetch_assoc()){
                                        ?>
                                        <li class="header__cart-item"> 
                                            <div class="header__cart-item-img" style="background-image: url(admin/uploads/<?php echo $result['proImg'] ?>);"></div>
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name"><?php echo $result['productName'] ?></h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price"><?php echo $fm->format_currency($result['priceNew']) ?>đ</span>
                                                        <span class="header__cart-item-multiply">x</span>
                                                        <span class="header__cart-item-qnt"><?php echo  $result['quantity'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="header__cart-item-body">
                                                    <span class="header__cart-item-description">
                                                    <?php if($result['type']==1) echo 'Size M'; else echo 'Size L' ?>
                                                    </span>
                                                    <span class="header__cart-item-remove">Xóa</span>
                                                </div>                              
                                            </div>
                                        </li>
                                        <?php
                                        }}
                                        ?>
                                    </ul>
                                    <a href="./cartIndex.php" class="btn header__cart-view-cart btn--primary">Xem giỏ hàng</a>
                                </div>
                                <?php }?>
                            </a>
                            </div>      
                        
                    </div>
                </div>
            </div>
        </header>
    </div>