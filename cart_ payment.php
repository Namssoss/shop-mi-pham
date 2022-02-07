<?php include 'inc/header2.php' ?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check==false){
        echo "<script>
               window.location.replace('login.php');
                </script>";
    }
?>
<?php
  if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id); 
    $delCart = $ct->del_all_data_cart(); 
    Session::set('qty', 0);
    echo "<script>
    window.location.replace('success.php');
     </script>";
  }    
?>
    <div class="bodyCart">
      <div class="grid wide">
        <div class="cart_payment">
        <?php
        $id = Session::get('customer_id');
        $get_customers = $cs->show_customers($id);
        if($get_customers){
            while($result = $get_customers->fetch_assoc()){
        ?>
          <div class="cart_payment_hd">
            <div class="cart_payment_hd1"></div>
            <div class="cart_payment_hd2">
              <div class="cart_payment_hd2_hd">
                <i class="fas fa-map-marker-alt"></i
                ><span style="margin-left: 10px">Địa Chỉ Nhận Hàng</span>
              </div>
              <div class="cart_payment_hd2_db">
                <p class="cart_payment_hd2_db1">
                  <b><?php echo $result['fname'].' '.$result['lname']?></b>
                  <b><?php echo $result['phone']?></b>
                </p>
                <p class="cart_payment_hd2_db_info">
                <?php echo $result['address']?>
                </p>
                <a
                  href="profile.php"
                  style="text-decoration: none"
                >
                  <p class="btn_change">THAY ĐỔI</p>
                </a>
              </div>
            </div>
          </div>
              <?php }}?>
              
          <div class="cart_payment_bd">
            <div class="cart_payment_bd_hd">
              <p class="cart_payment_bd_hd4">Sản phẩm</p>
              <p class="cart_payment_bd_hd2"></p>
              <p class="cart_payment_bd_hd1">Đơn giá</p>
              <p class="cart_payment_bd_hd1">Số lượng</p>
              <p class="cart_payment_bd_hd2">Thành tiền</p>
            </div>
            
            <div class="cart_payment_bd_bd-list">
            <?php
               $get_product_cart = $ct->get_product_cart();
               if($get_product_cart){
                  $subtotal = 0;
                  $i = 0;
                   while($result = $get_product_cart->fetch_assoc()){
            ?>
              <div class="cart_payment_bd_bd">
                <div class="cart_payment_bd_bd_pro">
                  <img
                    src="admin/uploads/<?php echo $result['proImg'] ?>"
                    alt=""
                    width="40px"
                    height="40px"
                  />
                  <div class="cart_payment_bd_bd_pro-name">
                  <?php echo $result['productName'] ?>
                  </div>
                </div>
                <div class="cart_payment_bd_bd_loai">
                  Loại: <span><?php if($result['type']==1) echo 'Size M'; else echo 'Size L' ?></span>
                </div>
                <div class="cart_payment_bd_bd_price"><span><?php echo $fm->format_currency($result['priceNew']) ?>₫</span></div>
                <div class="cart_payment_bd_bd_sl"><?php echo  $result['quantity'] ?></div>
                <div class="cart_payment_bd_bd_price-tt">
                  <span><?php if($result['quantity'] < 2) $total = $result['priceNew']*$result['quantity'];else{$total = $result['priceNew']*$result['quantity']; $total = $total - $total*0.1;} echo $fm->format_currency($total)?>₫</span>
                </div>
              </div>
              <?php 
            $i = $i+$result['quantity'];
            $subtotal += $total; }} ?>      
              
            </div>
            <div class="cart_payment_bd_ft">
              Tổng số tiền (<span><?php  echo $i ?></span> sản phẩm):
              <span class="cart_payment_bd_ft-price"><?php echo $fm->format_currency($subtotal) ?>₫</span>
            </div>
          </div>

          <div class="cart_payment_ft">
            <div class="cart_payment_ft_hd">
              <p class="cart_payment_ft_hd1">Phương thức thanh toán</p>
              <p>Thanh toán khi nhận hàng</p>
            </div>
            <div class="cart_payment_ft_bd">
              <div class="cart_payment_ft_bd_tt">
                <p>Tổng tiền hàng</p>
                <p class="cart_payment_ft_bds"><span><?php echo $fm->format_currency($subtotal) ?>₫</span></p>
              </div>
              <div class="cart_payment_ft_bd_phi">
                <p>Phí vận chuyển (Miễn phí vận chuyển cho đơn hàng từ 3.000.000₫)</p>
                <p class="cart_payment_ft_bds"><span><?php if($subtotal > 3000000) echo '0'; else echo ' 50.000' ?>₫</span></p>
              </div>
              <div class="cart_payment_ft_bd_tt-plus">
                <p>Tổng thanh toán:</p>
                <p class="cart_payment_ft_bds cart_payment_ft_bds-big">
                  <span><?php if($subtotal > 3000000) echo $fm->format_currency($subtotal) ; else{ $tt = $subtotal + 50000; echo $fm->format_currency($tt);  }?>₫</span>
                </p>
              </div>
            </div>
            <div class="cart_payment_ft_ft">
              <a href="cartIndex.php" class="cart_payment_ft_ft_back">
                <button class="cart_btn" style="margin-right: 10px;">Trở về</button>
              </a>
              <a href="?orderid=order" class="cart_payment_ft_ft_back">
                <button class="cart_btn">Đặt Hàng</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  
   
    <!-- Modal -->
    <!-- <div class="sua_chia_chi">
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <div>Địa chỉ mới</div>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body fix-size">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control fix-size-input" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
                        <input type="text" class="form-control fix-size-input" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" class="form-control fix-size-input" id="recipient-name">
                      </div>
                </form>
            </div>
            <div class="modal-footer ">
              <button
                type="button"
                class="btn btn-secondary fix-size"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="button" class="btn btn-primary fix-size">
                Save changes
              </button>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
  </body>
  <?php include 'inc/footer1.php' ?>
</html>
