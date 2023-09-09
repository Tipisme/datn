<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class JobStores
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getJobStoreByJobId($jobId, $userId)
    {
        $query = "SELECT * FROM tbl_jobstores WHERE jobId = '$jobId' AND userId = '$userId'";
        $result = $this->db->select($query);
        return $result;
    }

        public function getJobStoreByUserId($userId)
    {
        $query = "SELECT * FROM tbl_jobstores js INNER JOIN tbl_job j
        ON js.jobId = j.id
        WHERE  js.userId = '$userId' AND js.is_followed = 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function saveJobs($userId, $jobId){
        $jobId = $this->fm->validation($jobId);
        $userId = $this->fm->validation($userId);

        $jobId = mysqli_real_escape_string($this->db->link, $jobId);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        $delete = "DELETE FROM `tbl_jobstores` WHERE userId = $userId AND jobId = $jobId";
        $this->db->insert($delete);

        $query = "INSERT INTO `tbl_jobstores`( `jobId`, `userId`, `is_followed`) VALUES ('$jobId','$userId', 1)";

        $result = $this->db->insert($query);

        if ($result) {
            $alert = "<span style='color: green;'>Save Job Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Save Job Not Successfully</span>";
            return $alert;
        }
    }

    public function unfollow($userId, $jobId) {
        $jobId = $this->fm->validation($jobId);
        $userId = $this->fm->validation($userId);

        $jobId = mysqli_real_escape_string($this->db->link, $jobId);
        $userId = mysqli_real_escape_string($this->db->link, $userId);

        $query = "UPDATE `tbl_jobstores` SET `is_followed`= 0 WHERE userId = $userId AND jobId = $jobId ";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Unfollow Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Unfollow Not Successfully</span>";
            return $alert;
        }
    }
}