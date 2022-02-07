<?php include 'inc/header1.php'?>
<?php 
 if(isset($_GET['cartid'])){
  $cartid = $_GET['cartid'];
  $delcart = $ct->del_product_cart($cartid);
}    
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
     $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
   }
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit1'])){
    $cartId = $_POST['cartId'];
   $quantity = $_POST['quantity'];
   $update_quantity_cart1 = $ct->update_quantity_cart1($quantity,$cartId);
   if($quantity <= 1){
    $delcart = $ct->del_product_cart($cartId);
   }
  }
?>
    <div class="bodyCart">
      <div class="grid wide">
        <?php
          $check_cart = $ct->check_cart();
          if(!$check_cart){
            $i = 0;
        ?>  
        <!-- Khong co gi -->
        <div class="noCart">
                <img src="assets/img/no_cart.png" alt="">
                <p><b>Giỏ hàng của bạn còn trống</b></p>
                <a href="index.php" style="text-decoration: none;"><button class ='cart_btn'>MUA NGAY</button></a>
            </div>
        <?php }else{ ?>
        <!-- Co hang -->
        <div class="cart">
          <div class="cart_menu">
            <p class="cart_menu1">Sản Phẩm</p>
            <p class="cart_menu2">Đơn Giá</p>
            <p class="cart_menu3">Số Lượng</p>
            <p class="cart_menu4">Số Tiền</p>
            <p class="cart_menu5">Thao Tác</p>
          </div>
          <div class="cart_list">
            <?php
               $get_product_cart = $ct->get_product_cart();
               if($get_product_cart){
                  $subtotal = 0;
                  $i = 0;
                   while($result = $get_product_cart->fetch_assoc()){
            ?>
            <div class="cart-product-css">
              <div class="cart-product">
                <div class="cart-product_pro">
                  <img src="admin/uploads/<?php echo $result['proImg'] ?>" alt="" />
                  <p class="cart-product_pro_info">
                    <?php echo $result['productName'] ?>
                  </p>
                </div>
                <div class="cart-product_type">
                  <div class="cart-product_type-1">
                    <p>Phân Loại Hàng:</p>
                    <!-- <button></button> -->
                  </div>
                  <div class="cart-product_type-selected"><?php if($result['type']==1) echo 'Size M'; else echo 'Size L' ?></div>
                </div>
                <div class="cart-product_pice">
                  <p class="pice-old"><del><?php $priceOld = $result['priceNew'] + (($result['sale']/100) * $result['priceNew']); echo $fm->format_currency($priceOld) ?>₫</del></p>
                  <p class="pice-new"><?php echo $fm->format_currency($result['priceNew']) ?>₫</p>
                </div>
                <div class="cart-product_quantity">
                    <form action="" method="post">
                    <div class="quantily" style="display: flex;">
                        <button class="btn-" name="submit1"><span class="btn-re1">-</span></button>
                        <input type="hidden" name='cartId' value="<?php echo  $result['cartId'] ?>">
                          <input type="text" style="margin: 0;" class="inp_q" name="quantity" value="<?php echo  $result['quantity'] ?>" />
                        <button class="btn_c" name="submit"><span class="btn-re_c1">+</span></button>
                    </div>
                  </form>
                 </div>
                
                <div class="total_pro-price"><?php if($result['quantity'] < 2) $total = $result['priceNew']*$result['quantity'];else{$total = $result['priceNew']*$result['quantity']; $total = $total - $total*0.1;} echo $fm->format_currency($total)?>₫</div>
                <a href="?cartid=<?php echo  $result['cartId'] ?>" style="text-decoration: none;" class="cart-product_del">Xóa</a>
              </div>
            </div>
            <?php
            $i = $i+$result['quantity'];
            $subtotal += $total;
                   }}
            ?>
          </div>
        </div>

        <div class="cart_pay">
          
          <div class="cart_pay-text">
            Tổng thanh toán (<span class="cart_pay-text1"><?php  echo $i ?> </span>Sản phẩm): <span class="cart_pay-text2"><?php echo $fm->format_currency($subtotal) ?>₫</span>
          </div>
          <a href="./cart_ payment.php"><button class="cart_btn">Mua Hàng</button></a>
        </div>
        <?php }?>
        <?php Session::set('qty', $i)?>
      </div>
    </div>
    <?php include 'inc/footer.php' ?>
  </body>
</html>
