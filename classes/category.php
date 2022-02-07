<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../heplers/format.php');
?>

<?php
    class category
    {
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'> Category must be not empty</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Category Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Category Not Success</span>";
                    return $alert;
                }
            }
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_category where catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($catName,$id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id= mysqli_real_escape_string($this->db->link, $id);
            if(empty($catName)){
                $alert = "<span class='error'> Category must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Category Update Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Category Update Not Success</span>";
                    return $alert;
                }
            }
        }

        public function del_category($id){
            $query = "DELETE FROM tbl_category where catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Category Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Category Delete  Not Success</span>";
                return $alert;
            }
        }

        public function show_category_fontend(){
            $query = "SELECT * FROM tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id){
            $sp_tungtrang = 15;
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
            $tung_trang = ($page-1) * $sp_tungtrang;
            $query = "SELECT * FROM tbl_product WHERE catId='$id' order by productId desc LIMIT $tung_trang,$sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_category_search($text_search){
            $query_search = "SELECT * FROM tbl_category WHERE catName LIKE '%".$text_search."%'";
            $result_search = $this->db->select($query_search);
            return $result_search;
        }
        
    }
?>