<?php
    include 'inc/header.php'
?>
<?php
    
        $id_cart = $_GET['catId'];
     
        if(isset($_GET['soft'])){
            $name_soft = $_GET['soft'];
            $productbycat = $product->soft2($id_cart,$name_soft);  
        }else{
            $productbycat = $cat->get_product_by_cat($id_cart);
        } 
         

    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($catName,$id_cart);
    // }
?>
    <div class="app__container">
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
                            <li class="category-item <?php if($id_cart == $result_allcat['catId']) echo "category-item__link_active"  ?> ">
                                <a href="productbycat.php?catId=<?php echo $result_allcat['catId'] ?>" class="category-item__link "><?php echo $result_allcat['catName'] ?></a>
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
                        <a href="productbycat.php?catId=<?php echo $id_cart ?>&soft=pb">
                            <button class="home-filter__btn btn <?php if($name_soft == 'pb') echo "btn--primary" ?>" >Phổ biến</button>
                        </a>
                        <a href="productbycat.php?catId=<?php echo $id_cart ?>">
                            <button class="home-filter__btn btn <?php if(!isset($_GET['soft'])) echo "btn--primary" ?>">Mới nhất</button>
                        </a>
                        <a href="productbycat.php?catId=<?php echo $id_cart?>&soft=bc">
                           <button class="home-filter__btn btn <?php if($name_soft == 'bc') echo "btn--primary" ?>">Bán chạy</button> 
                        </a>

                        <div class="select-input">
                        <span class="select-input__label"><?php if($name_soft == 'tc'){ echo "Giá: Thấp đến cao"; }elseif($name_soft == 'ct'){echo "Giá: Cao đến thấp";} else{echo "Giá";}?></span>
                            <i class="select-input__icon fas fa-angle-down"></i>

                            <ul class="select-input__list">
                                <li class="select-input__item">
                                    <a href="productbycat.php?catId=<?php echo $id_cart ?>&soft=tc" class="select-input__link ">Giá: Thấp đến cao</a>
                                </li>
                                <li class="select-input__item">
                                    <a href="productbycat.php?catId=<?php echo $id_cart ?>&soft=ct" class="select-input__link">Giá: Cao đến thấp</a>
                                </li>
                            </ul>
                        </div>

                        <div class="home-filter__page">
                        <span class="home-filter__page-num">
                                <?php
                                    if($id_cart){
                                        $product_all = $product->get_all_productByid($id_cart);
                                    }else{
                                        $product_all = $product->get_all_product();
                                    } 
                                    $product_count = mysqli_num_rows($product_all);
                                    $product_button = ceil($product_count/15);
                                ?>
                                <span class="home-filter__page-current"><?php if($name_page) echo $name_page; else echo 1 ?></span>/<?php echo $product_button ?>
                            </span>

                            <div class="home-filter__page-control">
                                <a href="<?php echo 'productbycat.php?catId='.$id_cart.'&'?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page != 1){$name_page--; echo'&page='.$name_page.'';}else{echo'&page='.$name_page.'';}?>" class="home-filter__page-btn">
                                    <i class="home-filter__page-icon fas fa-angle-left"></i>
                                </a>
                                <a href="<?php echo 'productbycat.php?catId='.$id_cart.'&'?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page){if($name_page != $product_button){$name_page++; echo'&page='.$name_page.'';}else{echo'&page='.$name_page.'';}}else{ echo'&page=2';}?>" class="home-filter__page-btn">
                                    <i class="home-filter__page-icon fas fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- San pham -->
                    <div class="home-product">
                        <div class="grid__row">
                            <?php
                            if($productbycat){
                                while($result = $productbycat->fetch_assoc()){
                            ?>
                            <div class="grid__column-2-4">
                                <a class="home-product-item" href="product-index.php?proid=<?php echo $result['productId']?>">
                                    <div class="home-product-item__img" style="background-image: url(admin/uploads/<?php echo $result['proImg']?> );"></div>
                                    <h4 class="home-product-item__name"><?php echo $result['productName']?></h4>
                                    <div class="home-product-item__price">
                                        <span class="home-product-item__price-old"><?php $priceOld = $result['priceNew'] + (($result['sale']/100) * $result['priceNew']); echo $fm->format_currency($priceOld) ?>đ</span>
                                        <span class="home-product-item__price-current"><?php echo $fm->format_currency($result['priceNew'])?>đ</span>
                                    </div>
                                    <div class="home-product-item__action">
                                        <span class="home-product-item__like home-product-item__liked">
                                            <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                            <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                                        </span>
                                        <span class="home-product-item__sold"><?php echo $result['proS']?> đã bán</span>
                                    </div>
                                    <div class="home-product-item__origin">
                                        <span class="home-product-item__brand">Whoo</span>
                                        <span class="home-product-item__origin-name">Nhật Bản</span>
                                    </div>
                                    <?php 
                                        if($result['proS'] > 50){
                                    ?>
                                    <div class="home-product-item__favourite">
                                        <i class="fas fa-check"></i>
                                        <span>Yêu thích</span> 
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="home-product-item__sale-off">
                                        <span class="home-product-item__sale-off-percent"><?php echo $result['sale'] ?>%</span>
                                        <div class="home-product-item__sale-off-label">GIẢM</div>
                                    </div>
                                </a>
                            </div>
                            <?php
                                }
                            }else{?>
                            
                            <div class="no_pro_cat"><?php echo 'Không có sản phẩm nào trong danh mục này!' ?></div> 
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                    <?php
                            $productbycat = $cat->get_product_by_cat($id_cart);
                            if($productbycat){
                                include 'inc/pagination.php';
                            }
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

              <!-- Login form -->
              <!-- <div class="auth-form">
                <div class="modal__inner">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Đăng nhập</h3>
                        <span class="auth-form__switch-btn">Đăng ký</span>
                    </div>
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Email của bạn">
                        </div>
                        <div class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu">
                        </div>
                    </div>
    
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <span class="auth-form__help--link auth-form__help--forget">Quên mật khẩu</span>
                            <span class="auth-form__help--separate"></span>
                            <a href="" class="auth-form__help--link">Cần trợ giúp?</a>
                        </div>
                    </div>
    
                    <div class="auth-form__controls">
                        <button class="btn btn--back auth-form__control-back">TRỞ LẠI</button>
                        <button class="btn btn--primary">ĐĂNG NHẬP</button>
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
            </div>
        </div> -->
    </div>
    <script src="./style.js"></script>
</body>
</html>