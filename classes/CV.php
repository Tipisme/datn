<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class CV
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addCV($userId, $title, $file)
    {
        $title = $this->fm->validation($title);
        $userId = $this->fm->validation($userId);

        $title = mysqli_real_escape_string($this->db->link, $title);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        $permited = array('pdf', 'docx');
        $file_name = $_FILES['fileCV']['name'];
        $file_size = $_FILES['fileCV']['size'];
        $file_temp = $_FILES['fileCV']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_file = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_file = "./uploads/" . $unique_file;

        if (empty($title)) {
            $alert = "<span  style='color: red;'>CV must be not empty!</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                if ($file_size > (1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: " . implode(', ', $permited) . "</span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_file);
                $query = "INSERT INTO `tbl_cv`( `cvTitle`, `cvFile`, `userId`) VALUES ('$title','$unique_file','$userId')";
            }

            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color: green;'>Insert CV Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Insert CV Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function showAllCVByUserId($id){
        $query = "SELECT * FROM tbl_cv WHERE userId = $id AND isEnable = 0";
        $result = $this->db->select($query);
        return $result;
    }

    public function showCVById($id){
        $query = "SELECT * FROM tbl_cv WHERE cvId = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCV($id, $title, $file){
        $title = $this->fm->validation($title);

        $title = mysqli_real_escape_string($this->db->link, $title);

        $permited = array('pdf', 'docx');
        $file_name = $_FILES['fileCV']['name'];
        $file_size = $_FILES['fileCV']['size'];
        $file_temp = $_FILES['fileCV']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_file = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_file = "./uploads/" . $unique_file;

        if (empty($title)) {
            $alert = "<span  style='color: red;'>CV must be not empty!</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                if ($file_size > (1024 * 1024)) {
                    $alert = "<span  style='color: red;'>Image size should be less then 1MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    $alert = "<span  style='color: red;'>You can upload only: " . implode(', ', $permited) . "</span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_file);
                $query = "UPDATE `tbl_cv` SET `cvTitle`='$title',`cvFile`='$unique_file' WHERE cvId = '$id'";
            } else {
                $query = "UPDATE `tbl_cv` SET `cvTitle`='$title' WHERE cvId = '$id'";
            }

            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color: green;'>Update CV Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Update CV Not Successfully</span>";
                return $alert;
            }
        }
    }

    public function deleteCV($id){
        $query = "UPDATE `tbl_cv` SET `isEnable` = b'1' WHERE `tbl_cv`.`cvId` = $id";
        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Delete CV Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Delete CV Not Successfully</span>";
            return $alert;
        }
    }
}