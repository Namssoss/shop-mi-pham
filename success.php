<?php include 'inc/header.php' ?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo "<script>
               window.location.replace('login.php');
                </script>";
}
    $ct = new cart();
    if(isset($_GET['confirmid'])){
        $id = $_GET['confirmid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $del_shifted = $ct->del_shifted($id,$time,$price);
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
                        <div class="ss_body_profile"  style="color: var(--primary-color) ">
                            <a href="" >
                                <div class="ss_body_profile_item">
                                    <i class="far fa-calendar-minus"></i>
                                </div>
                                <span style="color: var(--primary-color) ">Đơn Mua</span>
                            </a>
                        </div>
                        <div class="ss_body_profile">
                            <a href="historyBuy.php" >
                                <div class="ss_body_profile_item">
                                    <i class="far fa-calendar-minus"></i>
                                </div>
                                <span>Đơn Hàng Đã Mua</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                 }}
                 ?>
                 <?php
                    $customer_id = Session::get('customer_id');
                    $get_product_order = $ct->get_product_order($customer_id);
                    if(!$get_product_order){       
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
                    <div class="ss-list">
                        <?php
                            $subtotal = 0;
                            $i = 0;
                                while($result = $get_product_order->fetch_assoc()){
                        ?>
                        <div class="ss-list_item d-flex">
                            <div class="ss-list_item_img">
                                <img src="admin/uploads/<?php echo $result['proImg'] ?>" alt="">
                            </div>
                            <div class="ss-list_item_bd d-flex justify-content-between">
                                <div class="ss-list_item_bd1">
                                    <p class="ss-list_item_bd1-1"><?php echo $result['productName'] ?></p>
                                    <p class="ss-list_item_bd1-2">Phân loại hàng: <span><?php if($result['type']==1) echo 'Size M'; else echo 'Size L' ?></span></p>
                                    <p class="ss-list_item_bd1-3">x <span><?php echo  $result['quantity'] ?></span></p>
                                </div>
                                <div class="ss-list_item_bd2 d-flex">
                                    <?php if($result['status'] == 0) {?>
                                    <p class="status">Đang chờ xử lý</p>
                                    <?php }elseif($result['status'] == 1){ ?>
                                    <p class="status"><a href="?confirmid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>">Đang vận chuyển hàng</a></p>
                                    <?php }else{?>
                                    <p class="status status_ss">Đã nhận được hàng</p>       
                                    <?php } ?>

                                    <p class="priOld"><del><?php $priceOld = $result['priceNew'] + (($result['sale']/100) * $result['priceNew']); echo $fm->format_currency($priceOld) ?>₫</del></p>
                                    <p class="priNew"><?php echo $fm->format_currency($result['priceNew']) ?>₫</p>
                                    <?php if($result['status'] == 0 || $result['status'] == 1){ ?>
                                    <a onclick="return confirm('Bạn có muốn Hủy không?')" href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>" >HỦY</a>
                                    <?php }else{ ?>
                                        <a href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>" >XÓA</a>
                                    <?php }?>    
                                </div>
                            </div>
                        </div>
                        <?php $subtotal += $result['price']; } ?>
                    </div>
                     <div class="ss-ft">
                         <div style="width: 100%;">
                             <div class="ss-ft_tt d-flex ">
                                 <div>
                                 <i class="fas fa-dollar-sign"></i>
                                 </div>
                                 <p>Tổng số tiền: <span class="ss-ft_tt_tt"><?php if($subtotal > 3000000) echo $fm->format_currency($subtotal) ; else{ $tt = $subtotal + 50000; echo $fm->format_currency($tt);  }?>₫</span></p>
                             </div>
                             <div class="ss-ft_bt">
                                 <a href="index.php">
                                     <button class="btn btn-buy " style="font-size: 1.4rem; padding: 10px; margin-right:5px ; ">Tiếp Tục Mua Hàng</button>
                                 </a>
                                 <a href="help.php">
                                     <button class="btn btn-add-cart ss_fix_btn" style="font-size: 1.4rem; padding: 10px;">Liên Hệ Cửa Hàng</button>
                                 </a>
                             </div>
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
