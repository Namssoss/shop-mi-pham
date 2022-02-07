<link rel="stylesheet" href="./cart.css" />
<?php include 'inc/header.php' ?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo "<script>
               window.location.replace('login.php');
                </script>";
}

    $ct = new cart();
    if(isset($_GET['idHistoryBuy'])){
        $id = $_GET['idHistoryBuy'];
        $shifted_confirm = $ct->del_historyBuy($id);
    }
?>
    <div class="app__container">
        <div class="grid wide">
            <div class="grid__row app__ss">
            <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if ($get_customers) {
                 while ($result = $get_customers->fetch_assoc()) {
            ?>
                <div class="grid__column-2">
                    <div class="ss_header">
                        <b><?php echo $result['fname'].' '.$result['lname'] ?></b>
                    </div>
                    <div class="ss_body">
                        <div class="ss_body_profile">
                            <a href="profile.php">
                                <div class="ss_body_profile_item">
                                    <i class="far fa-user"></i>
                                </div>
                                <span>Tài Khoản Của Tôi</span>
                            </a>
                        </div>
                        <div class="ss_body_profile" >
                            <a href="success.php" >
                                <div class="ss_body_profile_item">
                                    <i class="far fa-calendar-minus"></i>
                                </div>
                                <span>Đơn Mua</span>
                            </a>
                        </div>
                        <div class="ss_body_profile"  style="color: var(--primary-color) ">
                            <a href="" >
                                <div class="ss_body_profile_item">
                                    <i class="far fa-calendar-minus"></i>
                                </div>
                                <span style="color: var(--primary-color) ">Đơn Hàng Đã Mua</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                 }}
                 ?>
                 <?php
                    $customer_id = Session::get('customer_id');
                    $get_product_history = $ct->get_product_history($customer_id);
                    if(!$get_product_history){       
                 ?>
                 <div class="grid__column-10 ss_main">
                     <div class="noCart" style="text-align: center; font-size: 1.6rem;">
                        <img src="assets/img/no_cart.png" alt="" width="150px">
                        <p><b>Đơn hàng của bạn trống</b></p>
                        <a href="index.php" style="text-decoration: none;"><button class ='cart_btn'>MUA NGAY</button></a>
                    </div>
                 </div>
                <?php }else{
                 ?>
                <div class="grid__column-10 ss_main">
                <div class="cart">
          <div class="cart_menu">
            <p class="cart_menu1">Sản Phẩm</p>
            <p class="cart_menu2" style="width: 10.888%; text-align: center;">Số Lượng</p>
            <p class="cart_menu3" style="width: 10.888%; text-align: center;">Số Tiền</p>
            <p class="cart_menu4" style="width: 15.888%; text-align: center;">Ngày Mua</p>
            <p class="cart_menu5" style="text-align: center;">Thao Tác</p>
          </div>
          <div class="cart_list">
            <?php
                  $subtotal = 0;
                  $i = 0;
                   while($result = $get_product_history->fetch_assoc()){
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
                <div class="cart-product_quantity" style="width: 11%;">
                    <input type="text" style="margin: 0;" class="inp_q" name="quantity" value="<?php echo  $result['quantity'] ?>" readonly/> 
                 </div>
                <div class="total_pro-price"><?php if($result['quantity'] < 2) $total = $result['priceNew']*$result['quantity'];else{$total = $result['priceNew']*$result['quantity']; $total = $total - $total*0.1;} echo $fm->format_currency($total)?>₫</div>
                <div style="width: 16.888%; text-align: center;">2022-01-16 16:09:26</div>
                <a href="historyBuy.php?idHistoryBuy=<?php echo  $result['idHistoryBuy'] ?>" style="text-decoration: none;" class="cart-product_del">Xóa</a>
              </div>
            </div>
            <?php
            $i = $i+$result['quantity'];
            $subtotal += $total;
                   }
            ?>
          </div>
        </div>

        <div class="cart_pay">
          
          <div class="cart_pay-text" style="float:right ; width: 100%;">
            Tổng thanh toán (<span class="cart_pay-text1"><?php  echo $i ?> </span>Sản phẩm): <span class="cart_pay-text2"><?php echo $fm->format_currency($subtotal) ?>₫</span>
          </div>    
        </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
    <?php 
    include 'inc/footer1.php'
  ?>
  </body>
 
</html>
