<?php
include '../lib/session.php';
Session::checkSession();
ob_start();
?>
<?php
include 'inc/header.php'
?>

<?php include '../classes/category.php'?>

<?php $cat = new category();
    if(isset($_GET['delId'])){
        $id = $_GET['delId'];
        $delCat = $cat->del_category($id);
    }
    
    if(isset($_POST['submit']) && ($text_search = $_POST['timkiem'] != "")){
        $text_search = $_POST['timkiem'];
        $show_cate = $cat->show_category_search($text_search); 
    }else{
        $show_cate = $cat->show_category(); 
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
                        <a href="cartlist.php" style="text-decoration: none;">
                            <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục</h1>
                        </a>
                        <form action="cartlist.php?search=timkiem" method="POST">
                            <input type="text" placeholder="Tìm kiếm" name="timkiem">
                            <Button type="submit" name="submit">Tìm kiếm</Button>
                        </form>
                    </div>
                    <?php
                        if(isset($delCat)){
                            echo $delCat;
                        }
                    ?>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Serial NO.</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($show_cate){
                                        $i = 0;
                                        while($result = $show_cate->fetch_assoc()){
                                            $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['catName'] ?></td>
                                    <td> <a href="editcat.php?catId=<?php echo $result['catId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?delId=<?php echo $result['catId'] ?>">Delete</a></td>
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