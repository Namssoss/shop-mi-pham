<ul class="pagination home-product__pagination">
                        <?php
                            if($id_cart){
                                $product_all = $product->get_all_productByid($id_cart);
                            }
                            $product_count = mysqli_num_rows($product_all);
                            $product_button = ceil($product_count/15);
                            $i = 1;
                        ?>
                        <?php if($product_button > 1){
                            ?>
                        <li class="pagination-item">
                            <a href="<?php if(!$id_cart) echo 'index.php?';else{ echo 'productbycat.php?catId='.$id_cart.'&';} ?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page > 1){if($name_page){$name_page--; echo'&page='.$name_page.'';}}else{echo'&page='.$name_page.'';}?>" class="pagination-item__link pagination-item__link_fix">
                                <i class="pagination-item__icon fas fa-angle-left"></i>
                            </a>
                        </li>
                        <?php
                        }?>
                        <?php
                        for($i=1;$i<=$product_button;$i++)
                        {
                            echo '
                        <li class="pagination-item'?>
                        <?php
                            if(!isset($_GET['page']) && $i == 1){
                                echo 'pagination-item-active';
                            }else{
                                $name_page = $_GET['page'];
                                if($i == $name_page){
                                    echo 'pagination-item-active';
                                }
                            } 
                        ?>
                        
                        <?php echo '">
                            <a href="'?><?php if(!$id_cart) echo 'index.php?';else{ echo 'productbycat.php?catId='.$id_cart.'&';} ?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php echo'&page='.$i.'" class="pagination-item__link">'.$i.'</a>
                        </li>';
                        }
                        ?>
                        <?php if($product_button > 1){
                            ?>
                        <li class="pagination-item">
                            <a href="<?php if(!$id_cart) echo 'index.php?';else{ echo 'productbycat.php?catId='.$id_cart.'&';} ?><?php if($name_soft) echo 'soft='.$name_soft.''?><?php $name_page = $_GET['page']; if($name_page != $product_button){if($name_page){$name_page++; echo'&page='.$name_page.'';}else{ echo '&page=2';}}else{echo'&page='.$name_page.'';}?>" class="pagination-item__link">
                                <i class="pagination-item__icon fas fa-angle-right pagination-item__link_fix"></i>
                            </a>
                        </li>
                        <?php
                        }?>
                    </ul>