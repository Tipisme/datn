<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class User
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showAllAccount()
    {
        $query = "SELECT * FROM tbl_user ORDER BY userId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAccountById($id)
    {
        $query = "SELECT * FROM tbl_user WHERE userId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function lockedAccount($id)
    {
        $query = "UPDATE `tbl_user` SET `is_locked`= b'1' WHERE userId = $id ";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Locked User Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Locked User Not Successfully</span>";
            return $alert;
        }
    }

    public function openAccount($id)
    {
        $query = "UPDATE `tbl_user` SET `is_locked`= b'0' WHERE userId = $id ";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Open User Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Open User Not Successfully</span>";
            return $alert;
        }
    }

    public function upgradeAvatar($userId, $file)
    {
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['uploadInput']['name'];
        $file_size = $_FILES['uploadInput']['size'];
        $file_temp = $_FILES['uploadInput']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../uploads/" . $unique_image;

        if (!empty($file_name)) {
            if ($file_size > (1024 * 1024)) {
                $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                return $alert;
            } elseif (in_array($file_ext, $permited) === false) {
                $alert = "<span  style='color: red;'>You can upload only: " . implode(', ', $permited) . "</span>";
                return $alert;
            }

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE `tbl_user` SET `imageUrl`='$unique_image' WHERE userId = $userId";
        }

        $result = $this->db->update($query);
        Session::set('imageUrl',$unique_image);

        if ($result) {
            $alert = "<span style='color: green;'>Upload Avatar Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Upload Avatar Not Successfully</span>";
            return $alert;
        }
    }

    public function upgradeInfoAndAvatar($address, $phone, $userId, $file)
    {
        $address = $this->fm->validation($address);
        $phone = $this->fm->validation($phone);

        $address = mysqli_real_escape_string($this->db->link, $address);
        $phone = mysqli_real_escape_string($this->db->link, $phone);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['uploadInput']['name'];
        $file_size = $_FILES['uploadInput']['size'];
        $file_temp = $_FILES['uploadInput']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "./uploads/" . $unique_image;
        if(empty($address) || empty($phone)){
            $alert = "<span style='color: red;'>Vui lòng điền địa chỉ và số điện thoại</span>";
            return $alert;
        }
        if (!empty($file_name)) {
            if ($file_size > (1024 * 1024)) {
                $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                return $alert;
            } elseif (in_array($file_ext, $permited) === false) {
                $alert = "<span  style='color: red;'>You can upload only: " . implode(', ', $permited) . "</span>";
                return $alert;
            }

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE `tbl_user` SET `imageUrl`='$unique_image',`phone`='$phone',`address`='$address' WHERE userId = $userId";
            Session::set('imageUrl',$unique_image);
        } else {
            $query = "UPDATE `tbl_user` SET `phone`='$phone',`address`='$address' WHERE userId = $userId";
        }

        $result = $this->db->update($query);
        Session::set('address',$phone);
        Session::set('phone',$address);

        if ($result) {
            $alert = "<span style='color: green;'>Cập phật thông tin thành công</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Cập phật thông tin không thành công</span>";
            return $alert;
        }
    }


    public function changePassword($userId, $oldPass, $newPass, $confirmPass){
        $oldPass = $this->fm->validation($oldPass);
        $newPass = $this->fm->validation($newPass);
        $confirmPass = $this->fm->validation($confirmPass);

        $oldPass = mysqli_real_escape_string($this->db->link, $oldPass);
        $newPass = mysqli_real_escape_string($this->db->link, $newPass);
        $confirmPass = mysqli_real_escape_string($this->db->link, $confirmPass);

        $checkOldPass = "SELECT * FROM `tbl_user` WHERE password = '$oldPass' AND userId = $userId";
        $kq = $this->db->select($checkOldPass);
        if($kq) {
            if($newPass == $confirmPass) {
                $query = "UPDATE `tbl_user` SET `password`='$newPass' WHERE userId = $userId";
            } else {
                $alert = "<span style='color: red;'>New password and confirm password not match.</span>";
                return $alert;
            }
        } else {
            $alert = "<span style='color: red;'>Old password incorrect!!</span>";
            return $alert;
        }

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Upload New Password Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Upload New Password Not Successfully</span>";
            return $alert;
        }
    }

}

?>