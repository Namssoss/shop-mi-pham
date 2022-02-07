<?php 
    include '../lib/session.php';
    Session::checkSession();
    ob_start();
?>
<?php include '../classes/category.php' ?>

<?php
    include 'inc/header.php'
?>
<?php include '../classes/product.php' ?>
<?php
     $pd = new product();
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
         $insertSlider = $pd->insert_Slider($_POST,$_FILES);
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
                    <h1 class="h3 mb-1 text-gray-800">Thêm slider</h1>
                    

                    <!-- Content Row -->
                    <div class="row" >

                       <form action="" method="post" enctype="multipart/form-data" style="width: 100%;">
                       <?php
                        if(isset($insertSlider)){
                            echo $insertSlider;
                        }
                    ?>
                           <table style="width: 100%;">
                                <tr>
                                    <td width = 100px;>
                                        <label >Name</label>
                                    </td>
                                    <td>
                                        <input type="text" name="sliderName" placeholder="Enter slider Name..." class="medium" style="width: 100%;"> 
                                    </td>
                                </tr>
                              
                             <tr>
                                    <td>
                                        <label>Update image</label>
                                    </td>
                                    <td>
                                        <input type="file" name="slider_image" style="width: 100%;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Type</label>
                                    </td>
                                    <td>
                                    <select name="type" id="select" style="width: 100%;">
                                            <option>-----------Select type-----------</option>
                                            <option value="1">ON</option>
                                            <option value="2">Off</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="SAVE">
                                    </td>
                                </tr>
                           </table>
                       </form>

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

</body>

</html>