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
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $del_shifted = $ct->del_pro_rp($id);
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
                    <h2>Thống kê</h2>
                    <div class="block">
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
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $ct = new cart();
                                    $fm = new Format();
                                    $get_pro_rp = $ct->get_product_rp();
                                    if($get_pro_rp){
                                        $i = 0;
                                        $tt = 0;
                                        while($result = $get_pro_rp->fetch_assoc()){
                                            $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['time'] ?></td>
                                    <td><?php echo $result['productName'] ?></td>
                                    <td><?php echo $result['quantity'] ?></td>
                                    <td><?php echo $fm->format_currency($result['price']).' '.'VND'?></td>
                                    <td>
                                        <a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['idProRp']?>"> XÓA </a>
                                    </td>
                                </tr>
                                
                                <?php
                                    $tt = $tt + $result['price'];}
                                ?>
                                <tr>
                                    <td colspan="6">
                                        Tổng tiền: <?php echo $fm->format_currency($tt) ?>
                                    </td>
                                </tr>
                                <?php } ?>
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