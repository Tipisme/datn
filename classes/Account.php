<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/session.php');
    Session::checkLogin();
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
class Account
{
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function loginAccount($email, $pass) {
        $email = $this->fm->validation($email);
        $pass = $this->fm->validation($pass);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, $pass);

        if(empty($email) || empty($pass)) {
            $alert = "<span  style='color: red;'>Email and Password must be not empty!</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$pass' AND is_locked = 0 LIMIT 1";

            $result = $this->db->select($query);

            if($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login_customer',true);
                Session::set('userId',$value['userId']);
                Session::set('imageUrl',$value['imageUrl']);
                Session::set('name',$value['name']);
                Session::set('email',$value['email']);
                Session::set('level',$value['level']);
                if(isset($value['address'])) {
                    Session::set('address',$value['address']);
                }
                if(isset($value['phone'])) {
                    Session::set('phone',$value['phone']);
                }
                header('Location:index.php');
            } else {
                $alert = "<span  style='color: red;'>User and password not match. Or Account is locked </span>";
                return $alert;
            }
        }
    }

    public function registerAccount($name, $email, $pass, $confirmPass) {
        $name = $this->fm->validation($name);
        $email = $this->fm->validation($email);
        $pass = $this->fm->validation($pass);
        $confirmPass = $this->fm->validation($confirmPass);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, $pass);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $confirmPass = mysqli_real_escape_string($this->db->link, $confirmPass);


        if(empty($name) || empty($email) || empty($pass) || empty($confirmPass)) {
            $alert = "<span  style='color: red;'>Account must be not empty!</span>";
            return $alert;
        } else if($pass !== $confirmPass){
            $alert = "<span  style='color: red;'>Password not match!</span>";
            return $alert;
        }  else {
            if (isset($email)) {
                $check_email = "SELECT * FROM tbl_user WHERE email = '$email' ";
                $kq = $this->db->select($check_email);
                if($kq) {
                    $alert = "<span style='color: red;'>Email is exists.</span>";
                    return $alert;
                } else {
                    $query = "INSERT INTO `tbl_user`( `name`, `email`, `phone`, `address`, `provider`, `provider_id`, `imageUrl`, `password`, `adminId`, `level`) 
                    VALUES ('$name','$email','','','','','','$pass',1,0)";
        
                    $result = $this->db->insert($query);
        
                    if($result) {
                        $alert = "<span style='color: green;'>Create New Account Successfully</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='color: red;'>Create New Account Not Successfully</span>";
                        return $alert;
                    }
                }
    
            }

        }

    }

    public function registerRecruiterAccount($name, $email, $phone, $address, $position, $pass, $confirmPass) {
        $name = $this->fm->validation($name);
        $email = $this->fm->validation($email);
        $phone = $this->fm->validation($phone);
        $address = $this->fm->validation($address);
        $position = $this->fm->validation($position);
        $pass = $this->fm->validation($pass);
        $confirmPass = $this->fm->validation($confirmPass);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, $pass);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $position = mysqli_real_escape_string($this->db->link, $position);
        $confirmPass = mysqli_real_escape_string($this->db->link, $confirmPass);


        if(empty($name) || empty($email) || empty($pass) || empty($confirmPass) || empty($phone) || empty($address) || empty($position)) {
            $alert = "<span  style='color: red;'>Recruiter info must be not empty!</span>";
            return $alert;
        } else if($pass !== $confirmPass){
            $alert = "<span  style='color: red;'>Password not match!</span>";
            return $alert;
        } if (!($this->validatePhoneNumberVN($phone))) {
            $alert = "<span  style='color: red;'>Invalid phone number</span>";
            return $alert;
        } else {
            if (isset($email)) {
                $check_email = "SELECT * FROM tbl_user WHERE email = '$email' ";
                $kq = $this->db->select($check_email);
                if($kq) {
                    $alert = "<span style='color: red;'>Email is exists.</span>";
                    return $alert;
                } else {
                    $query = "INSERT INTO `tbl_user`( `name`, `email`, `phone`, `address`,`position`, `provider`, `provider_id`, `imageUrl`, `password`, `adminId`, `level`) 
                    VALUES ('$name','$email','$phone','$address','$position','','','','$pass',1,1)";
        
                    $result = $this->db->insert($query);
        
                    if($result) {
                        $alert = "<span style='color: green;'>Create New Recruiter Account Successfully</span>";
                        return $alert;
                    } else {
                        $alert = "<span style='color: red;'>Create New Recruiter Account Not Successfully</span>";
                        return $alert;
                    }
                }
    
            }

        }

    }


    public function loginRecruiterAccount($email, $pass) {
        $email = $this->fm->validation($email);
        $pass = $this->fm->validation($pass);

        $email = mysqli_real_escape_string($this->db->link, $email);
        $pass = mysqli_real_escape_string($this->db->link, $pass);

        if(empty($email) || empty($pass)) {
            $alert = "<span  style='color: red;'>Email and Password must be not empty!</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$pass' AND level = 1 AND is_locked = 0 LIMIT 1";

            $result = $this->db->select($query);

            if($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login_recruiter',true);
                Session::set('userId',$value['userId']);
                Session::set('imageUrl',$value['imageUrl']);
                Session::set('name',$value['name']);
                Session::set('address',$value['address']);
                Session::set('phone',$value['phone']);
                Session::set('position',$value['position']);
                Session::set('email',$value['email']);
                Session::set('level',$value['level']);

                header('Location:index.php');
            } else {
                $alert = "<span  style='color: red;'>User and password not match. Or Account is locked </span>";
                return $alert;
            }
        }
    }

    public function loginGoogle($fristName, $lastName, $email, $image) {
        $check_user = "SELECT * FROM tbl_user WHERE email = '$email'";
        $kq = $this->db->select($check_user);
        if($kq) {
            $value = $kq->fetch_assoc();
            Session::set('login_customer',true);
            Session::set('userId',$value['userId']);
            Session::set('imageUrl',$value['imageUrl']);
            Session::set('name',$value['name']);
            Session::set('email',$value['email']);
            Session::set('level',$value['level']);
            if(isset($value['address'])) {
                Session::set('address',$value['address']);
            }
            if(isset($value['phone'])) {
                Session::set('phone',$value['phone']);
            }
            header('Location:index.php');
        } else {
            $query = "INSERT INTO `tbl_user`( `name`, `email` , `imageUrl`, `level`, `is_locked`) 
            VALUES ('$lastName $fristName','$email','$image',0,0)";
            $this->db->insert($query);

            $check_email = "SELECT * FROM tbl_user WHERE email = '$email'";

            $result =$this->db->select($check_email);

            if($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login_customer',true);
                Session::set('userId',$value['userId']);
                Session::set('imageUrl',$value['imageUrl']);
                Session::set('name',$value['name']);
                Session::set('email',$value['email']);
                Session::set('level',$value['level']);
                if(isset($value['address'])) {
                    Session::set('address',$value['address']);
                }
                if(isset($value['phone'])) {
                    Session::set('phone',$value['phone']);
                }
                header('Location:index.php');
            } else {
                $alert = "<span  style='color: red;'>User and password not match. Or Account is locked </span>";
                return $alert;
            }
        }
        
    }

    public function loginFacebook( $fbid, $fbfullname, $fbemail, $fbpic){
        $check_user = "SELECT * FROM tbl_user WHERE email = '$fbemail'";
        $kq = $this->db->select($check_user);
        if($kq) {
            $value = $kq->fetch_assoc();
            Session::set('login_customer',true);
            Session::set('userId',$value['userId']);
            Session::set('imageUrl',$value['imageUrl']);
            Session::set('name',$value['name']);
            Session::set('email',$value['email']);
            Session::set('level',$value['level']);
            if(isset($value['address'])) {
                Session::set('address',$value['address']);
            }
            if(isset($value['phone'])) {
                Session::set('phone',$value['phone']);
            }
            header('Location:index.php');
        } else {
            $query = "INSERT INTO `tbl_user`( `name`, `email` , `imageUrl`, `level`, `is_locked`) 
            VALUES ('$fbfullname','$fbemail','$fbpic',0,0)";
            $this->db->insert($query);

            $check_email = "SELECT * FROM tbl_user WHERE email = '$fbemail'";

            $result =$this->db->select($check_email);

            if($result != false) {
                $value = $result->fetch_assoc();
                Session::set('login_customer',true);
                Session::set('userId',$value['userId']);
                Session::set('imageUrl',$value['imageUrl']);
                Session::set('name',$value['name']);
                Session::set('email',$value['email']);
                Session::set('level',$value['level']);
                if(isset($value['address'])) {
                    Session::set('address',$value['address']);
                }
                if(isset($value['phone'])) {
                    Session::set('phone',$value['phone']);
                }
                header('Location:index.php');
            } else {
                $alert = "<span  style='color: red;'>User and password not match. Or Account is locked </span>";
                return $alert;
            }
        }
    }

    private function validatePhoneNumberVN($phoneNumber) {
        $pattern = '/^(0|\+84)\d{9,10}$/';
        return preg_match($pattern, $phoneNumber);
    }
}

?>