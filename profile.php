<?php include 'inc/header.php' ?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    echo "<script>
               window.location.replace('login.php');
                </script>";
}
?>
<?php
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $UpdateCustomers = $cs->update_customers($_POST, $id);
}
?>
<div class="app__container">
    <div class="grid wide">
        <div class="grid__row">
        <?php
            if (isset($UpdateCustomers)) {
                echo $UpdateCustomers;
            }
            ?>
            <?php
            $id = Session::get('customer_id');
            $get_customers = $cs->show_customers($id);
            if ($get_customers) {
                while ($result = $get_customers->fetch_assoc()) {
        ?>
            <div class="grid__column-2" style="margin-top: 10px;">
                <div class="ss_header">
                    <b><?php echo $result['fname'].' '.$result['lname'] ?></b>
                </div>
                <div class="ss_body" >
                    <div class="ss_body_profile" >
                        <a href="" style="color: var(--primary-color) ">
                            <div class="ss_body_profile_item">
                                <i class="far fa-user"></i>
                            </div>
                            <span>Tài Khoản Của Tôi</span>
                        </a>
                    </div>
                    <div class="ss_body_profile" >
                        <a href="success.php">
                            <div class="ss_body_profile_item">
                                <i class="far fa-calendar-minus"></i>
                            </div>
                            <span>Đơn Mua</span>
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
            <div class="grid__column-10 ">
                <div class="fix-br">
                    <div class=" fix-br2">
                        <div class="profile-hd">
                            <div class="profile-hd-text">
                                <h3>Hồ Sơ Của Tôi</h3>
                                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                            </div>
                        </div>
                                <form action="" method="post">
                                    <div class="profile-bd">
                                        <div class="profile-bd_left">
                                            <div class="profile-bd_left_item">
                                                <div class="profile-bd_left_item1">Tên Đăng Nhập</div>
                                                <div class="profile-bd_left_item2"><?php echo $result['account'] ?></div>
                                            </div>
                                            <div class="profile-bd_left_item">
                                                <div class="profile-bd_left_item1">First Name</div>
                                                <div class="profile-bd_left_item2">
                                                    <input type="text" name="fname" value="<?php echo $result['fname'] ?>">
                                                </div>
                                            </div>
                                            <div class="profile-bd_left_item">
                                                <div class="profile-bd_left_item1">Last Name</div>
                                                <div class="profile-bd_left_item2">
                                                    <input type="text" name="lname" value="<?php echo $result['lname'] ?>">
                                                </div>
                                            </div>
                                            <div class="profile-bd_left_item">
                                                <div class="profile-bd_left_item1">Email</div>
                                                <div class="profile-bd_left_item2">
                                                    <input type="email" name="email" value="<?php echo $result['email'] ?>">
                                                </div>
                                            </div>
                                            <div class="profile-bd_left_item">
                                                <div class="profile-bd_left_item1">Số Điện Thoại</div>
                                                <div class="profile-bd_left_item2">
                                                    <input type="text" name="phone" value="<?php echo $result['phone'] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="profile-bd_left_item">
                    <div class="_119wWy">
                        <div class="d-flex" role="radiogroup">
                            <div class="stardust-radio stardust-radio--checked" tabindex="0" role="radio" aria-checked="true">
                                <div class="stardust-radio-button stardust-radio-button--checked">
                                    <div class="stardust-radio-button__outer-circle">
                                        <div class="stardust-radio-button__inner-circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="stardust-radio__content">
                                    <div class="stardust-radio__label">Nam</div>
                                </div>
                            </div>
                            <div class="stardust-radio" tabindex="0" role="radio" aria-checked="false">
                                <div class="stardust-radio-button">
                                    <div class="stardust-radio-button__outer-circle">
                                        <div class="stardust-radio-button__inner-circle">
                                        </div>
                                    </div>
                                </div>
                                <div class="stardust-radio__content">
                                    <div class="stardust-radio__label">Nữ</div>
                                </div>
                            </div>
                            <div class="stardust-radio" tabindex="0" role="radio" aria-checked="false">
                                <div class="stardust-radio-button">
                                    <div class="stardust-radio-button__outer-circle">
                                        <div class="stardust-radio-button__inner-circle"></div>
                                    </div>
                                </div>
                                <div class="stardust-radio__content">
                                    <div class="stardust-radio__label">Khác</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                                            <div class="profile-bd_left_item" >
                                                <div class="profile-bd_left_item1">Địa chỉ</div>
                                                <div class="profile-bd_left_item2"  style="width: 80%">
                                                    <input type="text" name="address" style="width: 100%" value="<?php echo $result['address'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="cart_btn" value="Lưu" name="save">
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
            <?php
                            }
                        }
                        ?>
        </div>
    </div>
</div>


<?php include 'inc/footer1.php' ?>
</body>

</html>