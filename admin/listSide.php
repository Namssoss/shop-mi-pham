<?php
include '../lib/session.php';
Session::checkSession();
ob_start();
?>
<?php
include 'inc/header.php'
?>

<?php include '../classes/category.php'?>
<?php include '../classes/product.php' ?>
<?php include_once '../heplers/format.php' ?>
<?php
    $product = new product();
    if(isset($_GET['up_slider']) && isset($_GET['type']) ){
        $id = $_GET['up_slider'];
        $type = $_GET['type'];
        $update_type_slider = $product->update_type_slider($id, $type);
    }

    if(isset($_GET['del_slider'])){
        $id = $_GET['del_slider'];
        $delete_type_slider = $product->delete_type_slider($id);
    }

    $get_slider = $product->show_slider1();
    if(isset($_POST['submit']) && ($text_search = $_POST['timkiem'] != "")){
        $text_search = $_POST['timkiem'];
        $get_slider = $product->show_slider1_search($text_search); 
    }else{
        $get_slider = $product->show_slider1();
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="listSide.php" style="text-decoration: none;">
                            <h1 class="h3 mb-0 text-gray-800">Danh sách Slider</h1>
                        </a>
                        <form action="listSide.php?search=timkiem" method="POST">
                            <input type="text" placeholder="Tìm kiếm" name="timkiem">
                            <Button type="submit" name="submit">Tìm kiếm</Button>
                        </form>
                    </div>
                    <?php
                        if(isset($delete_type_slider)){
                            echo $delete_type_slider;
                        }
                    ?>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NO.</th>
                                    <th scope="col">Slider Title</th>
                                    <th scope="col">Slider Image</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($get_slider){
                                        $i = 0;
                                        while($result_slider = $get_slider->fetch_assoc()){
                                            $i++;
                                    ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result_slider['sliderName'] ?></td>
                                    <td><img src="uploads/<?php echo $result_slider['slider_image']?>" width="200px"></td>
                                    <td><?php if($result_slider['type']==1){
                                        ?>
                                        <a href="?up_slider=<?php echo $result_slider['sliderId'] ?>&type=0">ON</a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="?up_slider=<?php echo $result_slider['sliderId'] ?>&type=1">OFF</a>
                                    <?php
                                    }
                                     ?></td>
                                    <td> <a onclick="return confirm('Are you want to delete?')" href="?del_slider=<?php echo $result_slider['sliderId'] ?>">Delete</a></td>
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
            <?php include 'inc/footer.php' ?>
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