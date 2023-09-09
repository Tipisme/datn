<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
class Banner
{
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addBanner($title, $description, $file){
        $title = $this->fm->validation($title);
        $description = $this->fm->validation($description);

        $title = mysqli_real_escape_string($this->db->link, $title);
        $description = mysqli_real_escape_string($this->db->link, $description);

        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../uploads/".$unique_image;

        if(empty($title) || empty($description) || empty($file_name)) {
            $alert = "<span  style='color: red;'>Banner must be not empty!</span>";
            return $alert;
        } else {
            if(!empty($file_name)) {
                if($file_size > (2*1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 2MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext,$permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: ".implode(', ', $permited)."</span>";
                    return $alert;
                }
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO `tbl_banner`( `bannerImage`, `bannerDescription`, `adminId`, `bannerTitle`)
             VALUES ('$unique_image','$description',1,'$title')";

            $result = $this->db->insert($query);

            if($result) {
                $alert = "<span style='color: green;'>Insert Banner Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Insert Banner Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function editBanner($bannerId, $title, $description, $file){
        $title = $this->fm->validation($title);
        $description = $this->fm->validation($description);

        $title = mysqli_real_escape_string($this->db->link, $title);
        $description = mysqli_real_escape_string($this->db->link, $description);

        $permited = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
        $uploaded_image = "../uploads/".$unique_image;

        if(empty($title) || empty($description) ) {
            $alert = "<span  style='color: red;'>Banner must be not empty!</span>";
            return $alert;
        } else {
            if(!empty($file_name)) {
                if($file_size > (2*1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 2MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext,$permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: ".implode(', ', $permited)."</span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE `tbl_banner` SET `bannerImage`='$unique_image',`bannerDescription`='$description',`bannerTitle`='$title' WHERE bannerId = $bannerId";
            } else {
                $query = "UPDATE `tbl_banner` SET `bannerDescription`='$description',`bannerTitle`='$title' WHERE bannerId = $bannerId ";
            } 


            $result = $this->db->insert($query);

            if($result) {
                $alert = "<span style='color: green;'>Edit Banner Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Edit Banner Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function showAllBanner() {
        $query = "SELECT * FROM tbl_banner ORDER BY bannerId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function showBannerById($id) {
        $query = "SELECT * FROM tbl_banner WHERE bannerId = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteBannerById($id) {
        $query = "DELETE FROM tbl_banner WHERE bannerId = '$id'";
        $result = $this->db->delete($query);

        if($result) {
            $alert = "<span style='color: green;'>Delete Banner Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Delete Banner Not Successfully</span>";
            return $alert;
        }
}
}