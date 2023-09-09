<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class Category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertCategory($catName)
    {
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span  style='color: red;'>Category must be not empty!</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";

            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color: green;'>Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Insert Category Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function showAllCategory()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCateById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteCategoryById($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span style='color: green;'>Delete Category Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Delete Category Not Successfully</span>";
            return $alert;
        }
    }

    public function updateCategory($catName, $id)
    {

        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $alert = "<span  style='color: red;'>Category must be not empty!</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";

            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color: green;'>Update Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Update Category Not Successfully</span>";
                return $alert;
            }
        }
    }
}

?>