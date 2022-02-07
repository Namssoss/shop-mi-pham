<?php include 'inc/header.php' ?>
<?php if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script>window.location ='404.php' </script>";
    }else{
        $id = $_GET['proid'];
    }  

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
      $AddtoCart = $ct->ad_to_cart($_POST,$id);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2'])){
      $AddtoCart = $ct->ad_to_cart2($_POST,$id);
    }
?>
    <div class="pro_body">
      <div class="grid wide">
        <?php
          $get_product_details = $product->get_details($id);
          if($get_product_details){
            while($result_details = $get_product_details->fetch_assoc()){
        ?>
        <div class="row br_w">
          <div class="col-4">
            <div class="img">
              <img src="admin/uploads/<?php echo $result_details['proImg'] ?>" alt="product-1"/>
              <div class="img_share d-flex mt-5 mb-4">
                <div class="img_share-share d-flex pr-5 pl-5">
                  <p class="mb-0">Chia sẻ:</p>
                  <div style="color: #0384ff">
                    <i class="fab fa-facebook-messenger"></i>
                  </div>
                  <div style="color: #3b5999">
                    <i class="fab fa-facebook"></i>
                  </div>
                  <div style="color: #de0217">
                    <i class="fab fa-pinterest"></i>
                  </div>
                </div>
                <div class="img_share-like d-flex pr-5 pl-5">
                    <div style="color: #ec273b"><i class="fas fa-heart"></i></div>
                    <p class="mb-0 ml-2">Yêu thích</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-8">
          <form action="" method="post">
            <div class="info-pro">
              <div class="info-pro_header">
                <?php echo $result_details['productName'] ?>
              </div>
              <div class="info-pro_price">
                <div class="info-pro_price_child">
                  <div class="info-pro_price_old">
                    <del><?php $priceOld = $result_details['priceNew'] + (($result_details['sale']/100) * $result_details['priceNew']); echo $fm->format_currency($priceOld) ?>đ</del>
                  </div>
                  <div class="info-pro_price_new"><?php echo $fm->format_currency($result_details['priceNew']) ?>đ</div>
                  <div class="info-pro_price_sale"><span><?php echo $result_details['sale'] ?>%</span> GIẢM</div>
                </div>
              </div>
              <div class="info-pro_body" style="font-size: 1.6rem">
                <div
                  class="info-pro_promotion d-flex pb-2"
                  style="align-items: center"
                >
                  <p class="pro1">Combo Khuyến Mãi</p>
                  <p class="pro2 info-pro_promotion_item">Mua 2 & giảm 10%</p>
                </div>
                <div class="info-pro_transport d-flex pb-5">
                  <p class="pro1">Vận Chuyển</p>
                  <div class="pro2" style="align-items: center">
                    <img
                      src="./assets/img/1cdd37339544d858f4d0ade5723cd477.png"
                      alt=""
                      width="25px"
                      height="15px"
                    />
                    <span>Miễn phí vận chuyển</span>
                    <div class="info-pro_transport_free">
                      Miễn phí vận chuyển cho đơn hàng trên 3.000.000₫
                    </div>
                  </div>
                </div>
                <div class="info-pro_type d-flex mb-5">
                  <p class="pro1">Chọn loại hàng</p>
                  <div class="pro2 d-flex">
                    <select name="type" id="select" style="width: 100%;">
                      <option value="1">Size M</option>
                      <option value="2">Size L</option>
                    </select>
                  </div>
                </div>
                <div class="info-pro_quantily d-flex mb-5">
                  <p class="pro1">Số lượng</p>
                  <div class="pro2 d-flex">
                  <div class="cart-product_quantity">       
                    <div class="quantily" style="display: flex;">
                        <button class="btn-" type="button" onclick="clickBtn1()"><span class="btn-re2">-</span></button>
                          <input type="text" style="margin: 0;" class="inp_q" name="quantity" value=1 />
                        <button class="btn_c" type="button" onclick="clickBtn2()"><span class="btn-re_c2">+</span></button>
                    </div>
                 </div>
                  <!-- <div class="cart-product_quantity">
                    <input type="text" name="quantity" value="1" style="width: 80px; height:32px; text-align:center; font-size: 1.7rem">
                 </div> -->
                    <p class="info-pro_quantily_ss mb-0">
                    <?php echo $result_details['proB'] ?> sản phẩm có sẵn
                    </p>
                  </div>
                </div>
              </div>
                <div class="info-pro_grBtn pl-4">
                <button name="submit2" class="btn btn-add-cart">
                  <span class="mr-3" style="font-size: 2rem"
                    ><i class="fas fa-cart-plus"></i></span
                  >Thêm Vào Giỏ Hàng
                </button>
                <button name="submit" class="btn btn-buy">Mua Ngay</button>
                <?php
              if(isset($AddtoCart)){
                echo $AddtoCart;
              }
            ?>
              </div>
            </div>
            
          </form>
          </div>
        </div>

        <div class="row br_w mt-4">
          <div class="pro_description">
            <div class="pro_description_header">MÔ TẢ SẢN PHẨM</div>
            <div class="pro_description_body">
              <span>
              <?php echo $result_details['prodesc'] ?>
              </span>
            </div>
          </div>
        </div>
      </div>
      <?php
      }}
      ?>
      
      <div class="grid wide">
        <div class="row mt-4" style="padding-bottom: 50px;"> 
            <div class="pro_plus">
              <div class="pro_plus pt-2 ">CÁC SẢN PHẨM KHÁC</div>
            </div>
            <div class="pro_plus-list">
            <?php
                        $get_product = $product->get_productS();
                        if($get_product){
                            while($result_pro = $get_product->fetch_assoc()){
                        ?>
                            <div class="grid__column-2-4">
                                <a class="home-product-item" href="product-index.php?proid=<?php echo $result_pro['productId']?>">
                                    <div class="home-product-item__img" style="background-image: url(admin/uploads/<?php echo $result_pro['proImg'] ?>);"></div>
                                    <h4 class="home-product-item__name"><?php echo $result_pro['productName'] ?></h4>
                                    <div class="home-product-item__price">
                                        <span class="home-product-item__price-old"><?php $priceOld = $result_pro['priceNew'] + (($result_pro['sale']/100) * $result_pro['priceNew']); echo $priceOld ?></span>
                                        <span class="home-product-item__price-current"><?php echo $result_pro['priceNew'] ?></span>
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
                                    <div class="home-product-item__favourite">
                                        <i class="fas fa-check"></i>
                                        <span>Yêu thích</span> 
                                    </div>
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
      </div>
    <?php 
    include 'inc/footer1.php'
  ?>
  </body>
  <?php echo '<script src="./js2.js"></script>' ?>
</html>
