<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

?>

<?php
class Advertisement
{
    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function insertAdvertisment($title, $description, $files) {
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
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_advertisement(title,description,image,adminId) VALUES('$title','$description','$unique_image','1')";

            $result = $this->db->insert($query);

            if($result) {
                $alert = "<span style='color: green;'>Insert Advertisement Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Insert Advertisement Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function updateAdvertisement($title, $description, $files , $id){
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

        if(empty($title) || empty($description)) {
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
            $query = "UPDATE tbl_advertisement SET title = '$title', description = '$description', image = '$unique_image'  WHERE id = '$id'";
        } else {
            $query = "UPDATE tbl_advertisement SET title = '$title', description = '$description'  WHERE id = '$id'";
        }

        $result = $this->db->update($query);

        if($result) {
            $alert = "<span style='color: green;'>Update Advertisement Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Update Advertisement Not Successfully</span>";
            return $alert;
        }
    }


    }

    public function showAllAdvertisment() {
        $query = "SELECT * FROM tbl_advertisement ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAdvertiseById($id) {
        $query = "SELECT * FROM tbl_advertisement WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteAdvertisementById($id) {
            $query = "DELETE FROM tbl_advertisement WHERE id = '$id'";
            $result = $this->db->delete($query);
    
            if($result) {
                $alert = "<span style='color: green;'>Delete Advertisement Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Delete Advertisement Not Successfully</span>";
                return $alert;
            }
    }

}

?>