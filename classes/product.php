<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../heplers/format.php');
?>

<?php
    class product
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data, $files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
            $prodesc = mysqli_real_escape_string($this->db->link, $data['prodesc']);
            $sale = mysqli_real_escape_string($this->db->link, $data['sale']);
            $priceNew = mysqli_real_escape_string($this->db->link, $data['priceNew']);
            $proS = mysqli_real_escape_string($this->db->link, $data['proS']);
            $proB = mysqli_real_escape_string($this->db->link, $data['proB']);
            // kiem tra hinh anh va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['proImg']['name'];
            $file_size = $_FILES['proImg']['size'];
            $file_temp = $_FILES['proImg']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $catId=="" || $prodesc=="" || $sale=="" || $priceNew=="" || $proS=="" || $proB=="" || $file_name==""){
                $alert = "<span class='error'> Fields must be not empty</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_product(productName, catId, proImg, prodesc, sale, priceNew, proS, proB) VALUES('$productName', '$catId', '$unique_image', '$prodesc', '$sale', '$priceNew', '$proS', '$proB')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Product Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Product Not Success</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = "SELECT tbl_product.*, tbl_category.catName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId order by tbl_product.productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product where productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data,$file,$id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
            $prodesc = mysqli_real_escape_string($this->db->link, $data['prodesc']);
            $sale = mysqli_real_escape_string($this->db->link, $data['sale']);
            $priceNew = mysqli_real_escape_string($this->db->link, $data['priceNew']);
            $proS = mysqli_real_escape_string($this->db->link, $data['proS']);
            $proB = mysqli_real_escape_string($this->db->link, $data['proB']);
            // kiem tra hinh anh va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['proImg']['name'];
            $file_size = $_FILES['proImg']['size'];
            $file_temp = $_FILES['proImg']['tmp_name'];
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            if($productName=="" || $catId=="" || $prodesc=="" || $sale=="" || $priceNew=="" || $proS=="" || $proB==""){
                $alert = "<span class='error'> Fields must be not empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    if(in_array($file_ext, $permited)===false){
                        $alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', proImg = '$unique_image', prodesc = '$prodesc',
                    sale = '$sale', priceNew = '$priceNew', proS = '$proS', proB = '$proB' WHERE productId ='$id'";
                }else{
                    $query = "UPDATE tbl_product SET productName = '$productName', catId = '$catId', prodesc = '$prodesc',
                    sale = '$sale', priceNew = '$priceNew', proS = '$proS', proB = '$proB' WHERE productId ='$id'";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Product Update Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Product Update Not Success</span>";
                    return $alert;
                }
            }
        }

        public function del_product($id){
            $query = "DELETE FROM tbl_product where productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Product Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Product Delete  Not Success</span>";
                return $alert;
            }
        }

        public function get_details($id){
            $query = "SELECT tbl_product.*, tbl_category.catName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId WHERE tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product(){
            $sp_tungtrang = 15;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $tung_trang = ($page-1) * $sp_tungtrang;
            $query = "SELECT * FROM tbl_product order by tbl_product.productId desc LIMIT $tung_trang,$sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_all_product(){
            $query = "SELECT * FROM tbl_product";
            $result = $this->db->select($query);
            return $result; 
        }

        public function get_all_products($text){
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%".$text."%'";
            $result = $this->db->select($query);
            return $result; 
        }

        public function get_all_productByid($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result; 
        }
        
        public function get_productS(){
            $query = "SELECT * FROM tbl_product order by RAND () LIMIT 5";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_Slider($data, $files){
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            // kiem tra hinh anh va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['slider_image']['name'];
            $file_size = $_FILES['slider_image']['size'];
            $file_temp = $_FILES['slider_image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($sliderName=="" || $type==""){
                $alert = "<span class='error'> Fields must be not empty</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName, type, slider_image) VALUES('$sliderName', '$type', '$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Slider Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Slider Not Success</span>";
                    return $alert;
                }
            }
        }

        public function show_slider(){
            $query = "SELECT * FROM tbl_slider WHERE type='1' order by sliderId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider1(){
            $query = "SELECT * FROM tbl_slider order by sliderId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type_slider($id, $type){
            $type = mysqli_real_escape_string($this->db->link, $type);
            $query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId ='$id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function delete_type_slider($id){
            $query = "DELETE FROM tbl_slider where sliderId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Slider Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Slider Delete Not Success</span>";
                return $alert;
            }
        }

        public function soft($name_soft){
            $sp_tungtrang = 15;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $tung_trang = ($page-1) * $sp_tungtrang;
            if ($name_soft == 'pb'){
                $query = "SELECT * FROM tbl_product order by RAND () LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'bc'){
                $query = "SELECT * FROM tbl_product order by proS desc LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'tc'){
                $query = "SELECT * FROM tbl_product order by priceNew ASC LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'ct'){
                $query = "SELECT * FROM tbl_product order by priceNew DESC LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }
        }

        public function soft2($id,$name_soft){
            $sp_tungtrang = 15;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $tung_trang = ($page-1) * $sp_tungtrang;
            if ($name_soft == 'pb'){
                $query = "SELECT * FROM tbl_product WHERE catId='$id' order by RAND () LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'bc'){
                $query = "SELECT * FROM tbl_product WHERE catId='$id' order by proS desc LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'tc'){
                $query = "SELECT * FROM tbl_product WHERE catId='$id' order by priceNew ASC LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }elseif($name_soft == 'ct'){
                $query = "SELECT * FROM tbl_product WHERE catId='$id' order by priceNew DESC LIMIT $tung_trang,$sp_tungtrang";
                $result = $this->db->select($query);
                return $result;
            }
        }

        public function searchProduct($text_his){
            $check = 0;
            $query_tbl_his = "SELECT * FROM tbl_history";
            $result_tbl_his = $this->db->select($query_tbl_his);
            if($result_tbl_his){
                while( $result_tbl_his_check = $result_tbl_his->fetch_assoc()){
                    if($text_his == $result_tbl_his_check['text_history']){
                        $check = 1;
                    }
                };
                if($check == 0 ){
                    $query = "INSERT INTO tbl_history(text_history) VALUES('$text_his')";
                    $result = $this->db->insert($query);
                }
            }else{
                $query = "INSERT INTO tbl_history(text_history) VALUES('$text_his')";
                $result = $this->db->insert($query);
            }
            $query_search = "SELECT * FROM tbl_product WHERE productName LIKE '%".$text_his."%'";
            $result_search = $this->db->select($query_search);
            return $result_search;
        }

        public function get_history(){
            $query_history = "SELECT * FROM tbl_history order by id desc LIMIT 5";
            $result_history = $this->db->select($query_history);
            return $result_history;
        }

        public function show_product_search($text_search){
            $query_search = "SELECT * FROM tbl_product WHERE productName LIKE '%".$text_search."%'";
            $result_search = $this->db->select($query_search);
            return $result_search;
        }

        public function show_slider1_search($text_search){
            $query_search = "SELECT * FROM tbl_slider WHERE sliderName LIKE '%".$text_search."%'";
            $result_search = $this->db->select($query_search);
            return $result_search;
        }
    }
?>