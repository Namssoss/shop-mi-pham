<?php 
    include '../lib/session.php';
    Session::checkSession();
    ob_start();
?>
<?php
    include 'inc/header.php'
?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    
?>
<?php
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo "<script>window.location ='index.php' </script>";
    }else{
        $id = $_GET['customerid'];
    }    
    $cs = new customer();
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Nguời dùng</h1>
                    <?php
                        $get_customer = $cs->show_customers($id);
                        if($get_customer){
                            while($result = $get_customer->fetch_assoc()){
                                
                        
                    ?>
                    <div class="row" style="margin-left: 10px;">
                        <form action="" method="post">
                            <div style="margin-bottom: 10px;">
                                <span>Name:</span>
                                <input type="text" value="<?php echo $result['fname'].' '.$result['lname'] ?>" readonly="readonly" name="catName">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span>Account:</span>
                                <input type="text" value="<?php echo $result['account']?>" readonly="readonly" name="catName">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span>Email:</span>
                                <input type="text" value="<?php echo $result['email'] ?>" readonly="readonly" name="catName">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span>Phone:</span>
                                <input type="text" value="<?php echo $result['phone']?>" readonly="readonly" name="catName">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span>Address:</span>
                                <input type="text" value="<?php echo $result['address']?>" readonly="readonly" name="catName">
                            </div>
                        </form>
                    </div>
                    <?php
                        }
                    }
                    ?>
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

</body>

</html>