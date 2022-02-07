<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
?>
<?php 
    include '../lib/session.php';
    Session::checkSession();
    ob_start();
?>
<?php
    include 'inc/header.php'
?>

<?php
    $ct = new cart();
    if(isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shifted = $ct->shifted($id,$time,$price);
    }

    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $del_shifted = $ct->del_shifted($id,$time,$price);
    }

    if(isset($_GET['confirmid'])){
        $id = $_GET['confirmid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <?php include 'inc/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'inc/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h2>Inbox</h2>
                    <div class="block">
                        <?php 
                            if(isset($shifted)){
                                echo $shifted;
                            }
                        ?>
                        <?php 
                            if(isset($del_shifted)){
                                echo $del_shifted;
                            }
                        ?>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Order Time</td>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>CustomerID</td>
                                    <td>Address</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $ct = new cart();
                                    $fm = new Format();
                                    $get_inbox_cart = $ct->get_inbox_cart();
                                    if($get_inbox_cart){
                                        $i = 0;
                                        while($result = $get_inbox_cart->fetch_assoc()){
                                            $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['dayOrder'] ?></td>
                                    <td><?php echo $result['productName'] ?></td>
                                    <td><?php echo $result['quantity'] ?></td>
                                    <td><?php echo $fm->format_currency($result['price']).' '.'VND'?></td>
                                    <td><?php echo $result['customer_id'] ?></td>
                                    <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">View Address</a></td>
                                    <td>
                                        <?php if($result['status']==0){ ?>
                                        <a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>">Xác nhận</a>
                                        <?php }elseif($result['status']== 1){ ?>
                                            <a href="?confirmid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>">Đang vận chuyển</a>
                                        <?php }else{ ?>
                                            <a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['dayOrder'] ?>">Vận chuyển thành công (XÓA)</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                       }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'inc/footer.php'?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
   <?php include 'inc/logoutModal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>