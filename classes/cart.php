<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../heplers/format.php');
?>

<?php 
    class cart{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function ad_to_cart($data,$id){
            $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            
            $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            $checkquatity = "SELECT * FROM tbl_product WHERE productId = '$id'";
 				$check_cart = $this->db->select($checkcart);
                $check_quatity = $this->db->select($checkquatity);
                $result_q = $check_quatity->fetch_assoc();
 				if($check_cart){
 					$alert = "<span class='cart_error'>Sản phẩm đã tồn tại!</span>";
 					return $alert;
 				}else if( $result_q['proB'] < $quantity){
                    $alert = "<span class='cart_error'>Bạn đã mua quá số lượng hàng!</span>";
 					return $alert;
                 }
                 else{
            $query_insert = "INSERT INTO tbl_cart(productId, type, quantity, sId) VALUE('$id', '$type', '$quantity', '$sId')";
            $insert_cart = $this->db->insert($query_insert);
            if($insert_cart){
               echo "<script>
               window.location.replace('cartIndex.php');
                </script>";
            }else{
                echo "<script>
                window.location.replace('404.php');
                 </script>";
            }
            }
        }

        public function ad_to_cart2($data,$id){
            
            $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            
            $checkcart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId = '$sId'";
            $checkquatity = "SELECT * FROM tbl_product WHERE productId = '$id'";
 				$check_cart = $this->db->select($checkcart);
                $check_quatity = $this->db->select($checkquatity);
                $result_q = $check_quatity->fetch_assoc();
 				if($check_cart){
 					$alert = "<span class='cart_error'>Sản phẩm đã tồn tại!</span>";
 					return $alert;
 				}else if( $result_q['proB'] < $quantity){
                    $alert = "<span class='cart_error'>Bạn đã mua quá số lượng hàng!</span>";
 					return $alert;
                 }
                 else{
            $query_insert = "INSERT INTO tbl_cart(productId, type, quantity, sId) VALUES('$id', '$type', '$quantity', '$sId')";
            $insert_cart = $this->db->insert($query_insert);
            if($insert_cart){
                $i = Session::get('qty');
                $i = $i + $quantity;
                Session::set('qty',$i);
                echo "<script>
                window.location.replace('product-index.php?proid=$id');
                 </script>";
            }else{
                echo "<script>
                window.location.replace('404.php');
                 </script>";
            }
            }
        }

        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT tbl_product.*, tbl_cart.* FROM tbl_product INNER JOIN tbl_cart ON tbl_product.productId = tbl_cart.productId WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity,$cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId= mysqli_real_escape_string($this->db->link, $cartId);
            $quantity++;
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId ='$cartId'";
            $result = $this->db->update($query);
        }

        public function update_quantity_cart1($quantity,$cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId= mysqli_real_escape_string($this->db->link, $cartId);
            $quantity--;
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId ='$cartId'";
            $result = $this->db->update($query);
        }

        public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM tbl_cart WHERE cartId ='$cartid'";
            $result = $this->db->delete($query);
        }

        public function check_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertOrder($customer_id){
            $sId = session_id();
            $query = "SELECT tbl_product.*, tbl_cart.* FROM tbl_product INNER JOIN tbl_cart ON tbl_product.productId = tbl_cart.productId WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productid = $result['productId'];
                    $quantity = $result['quantity'];
                    $type = $result['type'];
                    if($result['quantity'] < 2) $price = $result['priceNew']*$result['quantity'];else{$price = $result['priceNew']*$result['quantity']; $price = $price - $price*0.1;};
                    $customer_id = $customer_id;
                    
                    $query_order =  "INSERT INTO tbl_order(productId, quantity, type, price, customer_id) VALUES('$productid', '$quantity', '$type' , '$price', '$customer_id')";
                    $insert_order = $this->db->insert($query_order);
                }
            }
        }

        public function get_product_order($customer_id){
            $query = "SELECT tbl_product.*, tbl_order.* FROM tbl_product INNER JOIN tbl_order ON tbl_product.productId = tbl_order.productId WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_history($customer_id){
            $query = "SELECT tbl_product.*, tbl_historyBuy.* FROM tbl_product INNER JOIN tbl_historyBuy ON tbl_product.productId = tbl_historyBuy.productId WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_rp(){
            $query = "SELECT tbl_product.*, tbl_prorp.* FROM tbl_product INNER JOIN tbl_prorp ON tbl_product.productId = tbl_prorp.productId ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_inbox_cart(){
            $query = "SELECT tbl_product.*, tbl_order.* FROM tbl_product INNER JOIN tbl_order ON tbl_product.productId = tbl_order.productId ORDER BY dayOrder";
            $result = $this->db->select($query);
            return $result;
        }

        public function shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query1 = "SELECT * FROM tbl_order WHERE id = '$id'";
            $result_check = $this->db->select($query1);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
            if($value['status'] != 2){
                $query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND dayOrder='$time' AND price='$price'";
                $result = $this->db->insert($query);
                if($result){
                   $msg = "<span class='success'>Update Order Successfully</span>";
                   return $msg;
                }else{
                    $msg = "<span class='error'>Update Order Not Successfully</span>";
                   return $msg;
                }
            }
            }
            
        }

        public function del_shifted($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query = "DELETE FROM tbl_order WHERE id = '$id' AND dayOrder='$time' AND price='$price'";
            $result = $this->db->insert($query);
            if($result){
               $msg = "<span class='success'>Delete Order Successfully</span>";
               return $msg;
            }else{
                $msg = "<span class='error'>Delete Order Not Successfully</span>";
               return $msg;
            }
        }
        public function shifted_confirm($id,$time,$price){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $query_check = "SELECT * FROM tbl_order WHERE id = '$id'";
            $result_check_stt = $this->db->select($query_check);
            if($result_check_stt != false){
                $value = $result_check_stt->fetch_assoc();
            if($value['status'] != 2){
                $query1 = "SELECT tbl_product.*, tbl_order.* FROM tbl_product INNER JOIN tbl_order ON tbl_product.productId = tbl_order.productId WHERE id = '$id'";
            $result_check = $this->db->select($query1);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
                $proid = $value['productId'];
                $proSnew = $value['proS'] + $value['quantity'];
                $proBnew = $value['proB'] - $value['quantity'];
                $cus_id = $value['customer_id'];
                $type = $value['type'];
                $qtt= $value['quantity'];
                $q3 = "UPDATE tbl_product SET proS = '$proSnew', proB = '$proBnew' WHERE productId ='$proid' ";
                $result3 = $this->db->update($q3);

                $query_insert = "INSERT INTO tbl_historyBuy(productId, customer_id, type, quantity, totalPrice, dateBuy) VALUE('$proid', '$cus_id', '$type', '$qtt', '$price', '$time')";
                $insert_cart = $this->db->insert($query_insert);

                $query_insert1 = "INSERT INTO tbl_prorp(productId, time, quantity, price) VALUE('$proid', '$time', '$qtt', '$price')";
                $insert_cart1 = $this->db->insert($query_insert1);
            }
            }
            }
            $query = "UPDATE tbl_order SET status = '2' WHERE id = '$id' AND dayOrder='$time' AND price='$price'";
            $result = $this->db->insert($query);
            
        }

        public function del_historyBuy($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "DELETE FROM tbl_historyBuy WHERE idHistoryBuy  = '$id' ";
            $result = $this->db->insert($query);
        }

        public function del_pro_rp($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $query = "DELETE FROM tbl_prorp WHERE idProRp = '$id' ";
            $result = $this->db->insert($query);
        }
    }
?>