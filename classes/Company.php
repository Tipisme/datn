<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class Company
{
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showCompanyById($id) {
        $query = "SELECT * FROM tbl_company WHERE companyId = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllCompany() {
        $query = "SELECT * FROM tbl_company ORDER BY companyId DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllCompanyByUserId($id) {
        $query = "SELECT * FROM tbl_company WHERE userId = $id ORDER BY companyId DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompany($userId, $name, $description, $email, $phone, $files) {
        $name = $this->fm->validation($name);
        $description = $this->fm->validation($description);
        $email = $this->fm->validation($email);
        $phone = $this->fm->validation($phone);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../uploads/".$unique_image;

        if(empty($name) || empty($description) || empty($file_name) || empty($email) || empty($phone)) {
            $alert = "<span  style='color: red;'>Company must be not empty!</span>";
            return $alert;
        } else {
            if(!empty($file_name)) {
                if($file_size > (1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext,$permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: ".implode(', ', $permited)."</span>";
                    return $alert;
                }
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO `tbl_company`( `companyName`, `description`, `image`, `companyPhone`, `companyEmail`, `userId`) 
            VALUES ('$name','$description','$unique_image','$phone','$email','$userId')";

            $result = $this->db->insert($query);

            if($result) {
                $alert = "<span style='color: green;'>Insert Company Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Insert Company Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function updateCompany($id, $name, $description, $email, $phone, $file) {
        $name = $this->fm->validation($name);
        $description = $this->fm->validation($description);
        $email = $this->fm->validation($email);
        $phone = $this->fm->validation($phone);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $phone = mysqli_real_escape_string($this->db->link, $phone);

        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../uploads/".$unique_image;

        if(empty($name) || empty($description) || empty($email) || empty($phone)) {
            $alert = "<span  style='color: red;'>Advertisement must be not empty!</span>";
            return $alert;
        } else {
            if(!empty($file_name)) {
                if($file_size > (1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext,$permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: ".implode(', ', $permited)."</span>";
                    return $alert;
                }
            
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE `tbl_company` SET 
           `companyName`='$name',`description`='$description',`image`='$unique_image',`companyPhone`='$phone',`companyEmail`='$email' WHERE  companyId = '$id'";
        } else {
            $query = "UPDATE `tbl_company` SET 
            `companyName`='$name',`description`='$description',`companyPhone`='$phone',`companyEmail`='$email' WHERE companyId = '$id'";
        }

        $result = $this->db->update($query);

        if($result) {
            $alert = "<span style='color: green;'>Update Company Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Update Company Not Successfully</span>";
            return $alert;
        }
    }

    }
}