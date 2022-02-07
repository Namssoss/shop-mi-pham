<?php
    include 'inc/header.php'
?>
<?php
    //  $login_check = Session::get('customer_login');
    //  if($login_check==false){
    //     header('Location:login.php');
    //  }
?>
<?php
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
    }else{
        $id_cart = $_GET['catId'];
    }  
    if(isset($_GET['soft'])){
        $name_soft = $_GET['soft'];
        $get_product = $product->soft($name_soft);  
        $product_all = $product->get_all_product();
    }elseif(isset($_POST['submit']) && ($text_his = $_POST['timkiem'] != "")){
        $text_his = $_POST['timkiem'];
        $get_product = $product->searchProduct($text_his);
        $product_all = $product->get_all_products($text_his);
    }elseif(isset($_GET['timkiemm']) && $_GET['timkiemm'] != ""){
        $timkiem = $_GET['timkiemm'];
        $get_product = $product->searchProduct($timkiem);
        $product_all = $product->get_all_products($timkiem);
    }else{
        $get_product = $product->get_product();
        $product_all = $product->get_all_product();
    } 
     

    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($catName,$id);
    // }
?>
    <div class="app__container">
        <div class="slider">
            <div class="slideshow-container">
                <?php $get_slider = $product->show_slider();
                    if($get_slider){
                        while($result_slider = $get_slider->fetch_assoc()){
                ?>
                <div class="mySlides fade1" >
                    <div class="sl1" style="background-image: url('./admin/uploads/<?php echo $result_slider['slider_image'] ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
                </div>
                <?php }} ?>
            </div>
            <br>
            <div style="text-align:center">
            <?php $get_slider = $product->show_slider();
                    if($get_slider){
                        $i = 0;
                        while($result_slider = $get_slider->fetch_assoc()){
                ?>
                <span class="dot" onclick="currentSlide(<?php echo $i ?>)"></span> 
                <?php $i++; }} ?>
            </div>  
        </div>
        <div class="grid wide">
            <div class="grid__row app__content">
                <div class="grid__column-2">
                    <nav class="category">
                        <h3 class="category__heading">
                            <i class=" category__heading-icon fas fa-list"></i>
                            Danh mục
                        </h3>
            
                        <ul class="category-list">
                            <?php
                                $getall_category = $cat->show_category_fontend();
                                if($getall_category){
                                    while($result_allcat = $getall_category->fetch_assoc()){
                            ?>
                            <li class="category-item ">
                                <a href="productbycat.php?catId=<?php echo $result_allcat['catId'] ?>" class="category-item__link"><?php echo $result_allcat['catName'] ?></a>
                            </li>
                           <?php
                                    }
                                }
                           ?>
                        </ul>
                    </nav>
                </div>

                <div class="grid__column-10">
                    <div class="home-filter">
                        <span class="home-filter__label">Sắp xếp theo</span>
                        <a href="index.php?soft=pb">
                            <button class="home-filter__btn btn <?php if($name_soft == 'pb') echo "btn--primary" ?>" >Phổ biến</button>
                        </a>
                        <a href="index.php">
                            <button class="home-filter__btn btn <?php if(!isset($_GET['soft'])) echo "btn--primary" ?>">Mới nhất</button>
                        </a>
                        <a href="index.php?soft=bc">
                           <button class="home-filter__btn btn <?php if($name_soft == 'bc') echo "btn--primary" ?>">Bán chạy</button> 
                        </a>
                        <div class="select-input">
                            <span class="select-input__label"><?php if($name_soft == 'tc'){ echo "Giá: Thấp đến cao"; }elseif($name_soft == 'ct'){echo "Giá: Cao đến thấp";} else{echo "Giá";}?></span>
                            <i class="select-input__icon fas fa-angle-down"></i>

                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <a href="index.php?soft=tc" class="select-input__link ">Giá: Thấp đến cao</a>
                                </li>
                                <li class="select-input__item">
                                    <a href="index.php?soft=ct" class="select-input__link">Giá: Cao đến thấp</a>
                                </li>
                            </ul>
                        </div>

                        <div class="home-filter__page">
                            <span class="home-filter__page-num">
                                <?php
                                    $name_page = $_GET['page'];
                                    if($product_all>0){
                                    $product_count = mysqli_num_rows($product_all);
                                    $product_button = ceil($product_count/15);
                                    }else{
                                        $product_button= 1;
                                    }
                                ?>
                                <span class="home-filter__page-current"><?php if($name_page) echo $name_page; else echo 1 ?></span>/<?php echo $product_button ?>
                            </span>
                            <?php if($product_button > 1){
                            ?>
                            <div class="home-filter__page-control">
                                <a class="home-filter__page-btn" href="<?php echo 'index.php?'?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page != 1){$name_page--; echo'&page='.$name_page.'';}else{echo'&page='.$name_page.'';}?>" >
                                    <i class="home-filter__page-icon fas fa-angle-left"></i>
                                </a>
                                <a class="home-filter__page-btn" href="<?php echo 'index.php?'?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page){if($name_page != $product_button){$name_page++; echo'&page='.$name_page.'';}else{echo'&page='.$name_page.'';}}else{ echo'&page=2';}?>">
                                    <i class="home-filter__page-icon fas fa-angle-right"></i>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- San pham -->
                    <div class="home-product">
                        <div class="grid__row">
                        <?php
                        if($get_product){
                            while($result_pro = $get_product->fetch_assoc()){
                        ?>
                            <div class="grid__column-2-4">
                                <a class="home-product-item" href="product-index.php?proid=<?php echo $result_pro['productId']?>">
                                    <div class="home-product-item__img" style="background-image: url(admin/uploads/<?php echo $result_pro['proImg'] ?>);"></div>
                                    <h4 class="home-product-item__name"><?php echo $result_pro['productName'] ?></h4>
                                    <div class="home-product-item__price">
                                        <span class="home-product-item__price-old"><?php $priceOld = $result_pro['priceNew'] + (($result_pro['sale']/100) * $result_pro['priceNew']); echo $fm->format_currency($priceOld) ?>đ</span>
                                        <span class="home-product-item__price-current"><?php echo $fm->format_currency($result_pro['priceNew'])?>đ</span>
                                    </div>
                                    <div class="home-product-item__action">
                                        <span class="home-product-item__like home-product-item__liked">
                                            <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                            <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                                        </span>
                                       
                                        <span class="home-product-item__sold"><?php echo $result_pro['proS'] ?> đã bán</span>
                                    </div>
                                    <div class="home-product-item__origin">
                                        <span class="home-product-item__brand">Whoo</span>
                                        <span class="home-product-item__origin-name">Nhật Bản</span>
                                    </div>
                                    <?php 
                                        if($result_pro['proS'] > 50){
                                    ?>
                                    <div class="home-product-item__favourite">
                                        <i class="fas fa-check"></i>
                                        <span>Yêu thích</span> 
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="home-product-item__sale-off">
                                        <span class="home-product-item__sale-off-percent"><?php echo $result_pro['sale'] ?>%</span>
                                        <div class="home-product-item__sale-off-label">GIẢM</div>
                                    </div>
                                </a>
                            </div>
                            <?php
                            }}
                            ?>
                        </div>
                    </div>
                    <?php   
                    include 'inc/pagination.php' 
                    ?>
                
                </div>
            </div>
        </div>
    </div>
    <?php   
        include 'inc/footer.php' 
    ?>
    <!-- MODAL -->
    <!-- <div class="modal"> -->
        <!-- <div class="modal__ovarlay"></div>
        <div class="modal__body"> -->
                <!-- Register form -->
            <!-- <div class="auth-form">
                <div class="modal__inner">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng Ký</h3>
                        <span class="auth-form__switch-btn">Đăng nhập</span>
                    </div>
    
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Email của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
    
                    <div class="auth-form__aside">
                        <p class="auth-form__policy-text">
                            Bằng việc đăng kí, bạn đã đồng ý với Shop về
                            <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                            <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                        </p>
                    </div>
    
                    <div class="auth-form__controls">
                        <button class="btn btn--back auth-form__control-back">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG KÝ</button>
                    </div>
                </div>

                <div class="auth-form__socials">
                    <a href="" class="btn auth-form__socials--facebook btn--primary--size-s btn--with-icon">
                        <i class="fab auth-form__socials-icon fa-facebook-square"></i>
                        <span class="auth-form__socials-title">Kết nối với Facebook </span> 
                    </a>
                    <a href="" class="btn auth-form__socials--google btn--primary--size-s btn--with-icon">
                        <i class="fab auth-form__socials-icon fa-google"></i>
                        <span class="auth-form__socials-title">Kết nối với Google </span> 
                       
                    </a>
                </div>
            </div> -->
    </div>
   <?php echo '<script src="./style.js"></script>' ?>
</body>
</html>