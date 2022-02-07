<?php 
    include '../lib/session.php';
    Session::checkSession();
    ob_start();
?>
<?php include '../classes/category.php' ?>

<?php
    include 'inc/header.php'
?>
<?php include_once '../classes/product.php' ?>
<?php
     $pd = new product();
     if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
        echo "<script>window.location ='listpro.php' </script>";
    }else{
        $id = $_GET['productId'];
    } 
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

         $updateProduct = $pd->update_product($_POST,$_FILES,$id);
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
                    <h1 class="h3 mb-1 text-gray-800">Sửa sản phẩm</h1>
                    

                    <!-- Content Row -->
                    <div class="row" >
                    <?php
                        if(isset($updateProduct)){
                            echo $updateProduct;
                        }
                    ?>
                        <?php
                        $get_product_by_id = $pd->getproductbyId($id);
                            if($get_product_by_id){
                                while($result_product = $get_product_by_id->fetch_assoc()){
                        ?>
                       <form action="" method="post" enctype="multipart/form-data" style="width: 100%;">
                           <table style="width: 100%;">
                                <tr>
                                    <td width = 100px;>
                                        <label >Name</label>
                                    </td>
                                    <td>
                                        <input type="text" name="productName" value="<?php echo $result_product['productName']?>" class="medium" style="width: 100%;"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Category</label>
                                    </td>
                                    <td>
                                        <select name="catId" id="select" style="width: 100%;">
                                            <option>-----------Select Category-----------</option>
                                            <?php 
                                                $cat = new category();
                                                $catlist = $cat->show_category();
                                                if($catlist){
                                                    while($result = $catlist->fetch_assoc()){
                                            ?>
                                            <option
                                            <?php
                                                if($result['catId'] = $result_product['catId']){ echo 'selected';}
                                            ?>
                                            value="<?php echo $result['catId']?>"><?php echo $result['catName'] ?></option>

                                            <?php }} ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Update image</label>
                                    </td>
                                    <td>
                                    <img src="uploads/<?php echo $result_product['proImg'] ?>" width="80px">
                                        <input type="file" name="proImg" style="width: 100%;">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Description</label>
                                    </td>
                                    <td>
                                        <textarea name="prodesc" style="width: 100%;"><?php echo $result_product['prodesc']?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Sale</label>
                                    </td>
                                    <td>
                                    <input type="text" value="<?php echo $result_product['sale']?>" name="sale" style="width: 20%;">%
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label>New price</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $result_product['priceNew']?>" name="priceNew" style="width: 100%;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Products available</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $result_product['proS']?>" name="proS" style="width: 100%;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Products sold</label>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $result_product['proB']?>" name="proB" style="width: 100%;">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                    
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" Value="Update">
                                    </td>
                                </tr>
                           </table>
                       </form>
                        <?php
                        }
                    }
                    
                        ?>
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
    <?php include 'inc/logoutModal.php'  ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>