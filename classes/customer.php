<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../heplers/format.php');
?>

<?php 
    class customer{
        private $db;
        private $fm;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
       public function insert_customer($data){
        $fname = mysqli_real_escape_string($this->db->link, $data['fname']);
        $lname = mysqli_real_escape_string($this->db->link, $data['lname']);
        $account = mysqli_real_escape_string($this->db->link, $data['account']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $repassword = mysqli_real_escape_string($this->db->link, md5($data['repassword']));
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if($fname=="" || $lname=="" || $account=="" || $password=="" || $repassword=="" || $email=="" || $address=="" || $phone==""){
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        }elseif($password != $repassword){
            $alert = "<span class='error'>Mật khẩu không trùng khớp! Vui lòng thử lại.</span>";
            return $alert;
        }else{
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if($result_check){
                $alert = "<span class='error'>Email đã tồn tại</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_customer(fname, lname, account, password, repassword, email, address, phone) VALUES('$fname', '$lname', '$account', '$password', '$repassword', '$email', '$address', '$phone')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Đăng ký thành công!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Đăng ký thất bại! Vui lòng thử lại.</span>";
                    return $alert;
                }
            }
        };
       }

       public function login_customer($data){
        $account = mysqli_real_escape_string($this->db->link, $data['account']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if($account=="" || $password==""){
            $alert = "<span class='error'>Không được để trống</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM tbl_customer WHERE account = '$account' AND password='$password'";
            $result_check = $this->db->select($check_login);
            if($result_check != false){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['id']);
                Session::set('customer_name',$value['lname']);
                header('Location:index.php');
            }else{
                $alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng!</span>";
                return $alert;
            }
        }
       }

       public function show_customers($id){
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
       }

       public function update_customers($data, $id){
        $fname = mysqli_real_escape_string($this->db->link, $data['fname']);
        $lname = mysqli_real_escape_string($this->db->link, $data['lname']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if($fname=="" || $lname=="" || $email=="" || $address=="" || $phone==""){
            $alert = "<span class='error2'>Không được để trống</span>";
            return $alert;
        }else{
                $query = "UPDATE tbl_customer SET fname='$fname', lname='$lname', email='$email', address='$address', phone='$phone' WHERE id='$id'";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success2'>Đã lưu thay đổi!</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error2'>Lưu thất bại! Vui lòng thử lại.</span>";
                    return $alert;
                }
        };
       }
    }
?>