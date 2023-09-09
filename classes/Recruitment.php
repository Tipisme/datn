<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class Recruitment
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function applyJob($jobId, $cvId, $date, $userId)
    {
        $jobId = $this->fm->validation($jobId);
        $userId = $this->fm->validation($userId);
        $cvId = $this->fm->validation($cvId);


        $jobId = mysqli_real_escape_string($this->db->link, $jobId);
        $cvId = mysqli_real_escape_string($this->db->link, $cvId);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        if (empty($jobId) || empty($userId) || empty($cvId)) {
            $alert = "<span  style='color: red;'>Info must be not empty!</span>";
            return $alert;
        } else {
            $check = "SELECT * FROM `tbl_recruitment` WHERE jobId = '$jobId' AND userId = '$userId'";
            $kq = $this->db->select($check);
            if ($kq) {
                $alert = "<span  style='color: red;'>You applied!</span>";
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_recruitment`( `cvId`, `jobId`, `createdAt`, `userId`) VALUES ('$cvId','$jobId','$date','$userId')";

                $result = $this->db->insert($query);

                if ($result) {
                    $alert = "<span style='color: green;'>Apply Job Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color: red;'>Apply Job Not Successfully</span>";
                    return $alert;
                }
            }
        }
    }

    public function showAllRecruimentUserId($id){
        $query = "SELECT * FROM tbl_recruitment r INNER JOIN tbl_job j ON r.jobId = j.id WHERE r.userId = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllRecruimentRecruiterId($id){
        $query = "SELECT *, r.userId as 'jobseekerId' FROM tbl_recruitment r 
                  INNER JOIN tbl_user u ON u.userId = r.userId
                  INNER JOIN tbl_job j ON r.jobId = j.id WHERE j.userId = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteByRecruimentId($id) {
        $query = "DELETE FROM `tbl_recruitment` WHERE `tbl_recruitment`.`id` = $id";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span style='color: green;'>Delete Recruitment Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Delete Recruitment Not Successfully</span>";
            return $alert;
        }
    }
}