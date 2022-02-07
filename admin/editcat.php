<?php 
    include '../lib/session.php';
    Session::checkSession();
    ob_start();
?>
<?php
    include 'inc/header.php'
?>
<?php include '../classes/category.php' ?>
<?php
    $cat = new category();
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
        echo "<script>window.location ='cartlist.php' </script>";
    }else{
        $id = $_GET['catId'];
    }    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $catName = $_POST['catName'];
        
        $updateCat = $cat->update_category($catName,$id);
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Sửa danh mục</h1>
                    <?php
                        if(isset($updateCat)){
                            echo $updateCat;
                        }
                    ?>
                    <?php
                        $get_cate_name = $cat->getcatbyId($id);
                        if($get_cate_name){
                            while($result = $get_cate_name->fetch_assoc()){
                                
                        
                    ?>
                    <div class="row" style="margin-left: 10px;">
                        <form action="" method="post">
                            <input type="text" value="<?php echo $result['catName'] ?>" placeholder = "Sửa sản phẩm" name="catName">
                            <input type="submit" name="submit" Value="SAVE">
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