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
<?php $cat = new product();
      if(isset($_GET['productId'])){
        $id = $_GET['productId'];
        $delpro = $cat->del_product($id);
    }  
    $pd = new product();
    if(isset($_POST['submit']) && ($text_search = $_POST['timkiem'] != "")){
        $text_search = $_POST['timkiem'];
        $pdlist = $pd->show_product_search($text_search); 
    }else{
        $pdlist = $pd->show_product();
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
                        <a href="listpro.php" style="text-decoration: none;">
                            <h1 class="h3 mb-0 text-gray-800">Danh sách sản phẩm</h1>
                        </a>
                        <form action="listpro.php?search=timkiem" method="POST">
                            <input type="text" placeholder="Tìm kiếm" name="timkiem">
                            <Button type="submit" name="submit">Tìm kiếm</Button>
                        </form>
                    </div>
                    <?php
                        if(isset($delpro)){
                            echo $delpro;
                        }
                    ?>
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Sale</th>
                                    <th scope="col">Price New</th>
                                    <th scope="col">Products Sold</th>
                                    <th scope="col">Products Backlog</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $fm = new Format();
                                    if($pdlist){
                                        $i = 0;
                                        while($result = $pdlist->fetch_assoc()){
                                            $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['productName'] ?></td>
                                    <td><?php echo $result['catName'] ?></td>
                                    <td><img src="uploads/<?php echo $result['proImg'] ?>" width="80px"></td>
                                    <td><?php echo  $fm->textShorten($result['prodesc'], 50) ?></td>
                                    <td><?php echo $result['sale']  ?></td>
                                    <td><?php echo $fm->format_currency($result['priceNew']) ?></td>
                                    <td><?php echo $result['proS'] ?></td>
                                    <td><?php echo $result['proB'] ?></td>
                                    <td> <a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?productId=<?php echo $result['productId'] ?>">Delete</a></td>
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