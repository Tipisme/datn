<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php
class Job
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function showAllJob()
    {
        $query = "SELECT * FROM tbl_job ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllJobApproveAndNotRemove()
    {
        $query = "SELECT * FROM tbl_job WHERE status = 0 AND is_approve = 1 AND is_remove = 0 ORDER BY id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function showJobFeater()
    {
        $query = "SELECT * FROM tbl_job WHERE status = 0 AND is_approve = 1 AND is_remove = 0 ORDER BY id desc LIMIT 5";
        $result = $this->db->select($query);
        return $result;
    }

    public function getJobById($id)
    {
        $query = "SELECT * FROM tbl_job WHERE id = $id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllJobByPartTime(){
        $query = "SELECT * FROM tbl_job WHERE time = 'Part Time' AND status = 0 AND is_approve = 1 AND is_remove = 0 ORDER BY id desc LIMIT 5";
        $result = $this->db->select($query);
        return $result;
    }

    public function showAllJobByFullTime(){
        $query = "SELECT * FROM tbl_job WHERE time = 'Full Time' AND status = 0 AND is_approve = 1 AND is_remove = 0 ORDER BY id desc LIMIT 5";
        $result = $this->db->select($query);
        return $result;
    }

    public function searchingJob($keyword, $salary, $categoryId){
        $select = "SELECT * FROM tbl_job WHERE 1=1 ";
        if(!$keyword == "") {
            $select .= " AND `title` LIKE '%$keyword%'";
        }

        if(!$salary == "") {
            $select .= " AND ( `min_salary` <= $salary AND `max_salary` >= $salary )";
        }

        if(!$categoryId == "") {
            $select .= " AND `categoryId` = $categoryId ";
        }
        
        $select .= " AND status = 0 AND is_approve = 1 AND is_remove = 0 ORDER BY id desc";

        $result = $this->db->select($select);
        return $result;
    }

    public function addJob($title, $typeOfCv, $level, $address, $minSalary, $maxSalary, $description, $requireJob, $welfare, $userId, $categoryId, $deadline, $language, $time, $companyId)
    {
        $title = $this->fm->validation($title);
        $typeOfCv = $this->fm->validation($typeOfCv);
        $level = $this->fm->validation($level);
        $address = $this->fm->validation($address);
        $minSalary = $this->fm->validation($minSalary);
        $maxSalary = $this->fm->validation($maxSalary);
        $description = $this->fm->validation($description);
        $requireJob = $this->fm->validation($requireJob);
        $welfare = $this->fm->validation($welfare);
        $userId = $this->fm->validation($userId);
        $categoryId = $this->fm->validation($categoryId);
        $companyId = $this->fm->validation($companyId);
        $deadline = $this->fm->validation($deadline);
        $language = $this->fm->validation($language);
        $time = $this->fm->validation($time);

        $title = mysqli_real_escape_string($this->db->link, $title);
        $typeOfCv = mysqli_real_escape_string($this->db->link, $typeOfCv);
        $level = mysqli_real_escape_string($this->db->link, $level);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $minSalary = mysqli_real_escape_string($this->db->link, $minSalary);
        $maxSalary = mysqli_real_escape_string($this->db->link, $maxSalary);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $requireJob = mysqli_real_escape_string($this->db->link, $requireJob);
        $welfare = mysqli_real_escape_string($this->db->link, $welfare);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $categoryId = mysqli_real_escape_string($this->db->link, $categoryId);
        $companyId = mysqli_real_escape_string($this->db->link, $companyId);
        $deadline = mysqli_real_escape_string($this->db->link, $deadline);
        $language = mysqli_real_escape_string($this->db->link, $language);
        $time = mysqli_real_escape_string($this->db->link, $time);

        if (
            empty($title) || empty($typeOfCv) || empty($level) || empty($address) || empty($minSalary) || empty($maxSalary) || empty($description)
            || empty($requireJob) || empty($welfare) || empty($userId) || empty($categoryId) || empty($deadline) || empty($time)
        ) {
            $alert = "<span  style='color: red;'>Job info must be not empty!</span>";
            return $alert;
        } else {
            $query = "INSERT INTO `tbl_job`(`title`, `type_of_cv`, `level`, `address`, `min_salary`, `max_salary`, `description`, `require_job`, `welfare`, `language`, `userId`, `categoryId`,`companyId`, `deadline`, `status`, `is_approve`, `is_remove`, `time`) 
                    VALUES ('$title','$typeOfCv','$level','$address','$minSalary','$maxSalary','$description',
                    '$requireJob','$welfare','$language','$userId','$categoryId','$companyId','$deadline',0,0,0,'$time')";

            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color: green;'>Create New Job Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Create New Job Not Successfully</span>";
                return $alert;
            }
        }

    }


    public function updateJob($id,$title, $typeOfCv, $level, $address, $minSalary, $maxSalary, $description, $requireJob, $welfare, $userId, $categoryId, $deadline, $language, $time, $companyId)
    {
        $title = $this->fm->validation($title);
        $typeOfCv = $this->fm->validation($typeOfCv);
        $level = $this->fm->validation($level);
        $address = $this->fm->validation($address);
        $minSalary = $this->fm->validation($minSalary);
        $maxSalary = $this->fm->validation($maxSalary);
        $description = $this->fm->validation($description);
        $requireJob = $this->fm->validation($requireJob);
        $welfare = $this->fm->validation($welfare);
        $userId = $this->fm->validation($userId);
        $categoryId = $this->fm->validation($categoryId);
        $companyId = $this->fm->validation($companyId);
        $deadline = $this->fm->validation($deadline);
        $language = $this->fm->validation($language);
        $time = $this->fm->validation($time);

        $title = mysqli_real_escape_string($this->db->link, $title);
        $typeOfCv = mysqli_real_escape_string($this->db->link, $typeOfCv);
        $level = mysqli_real_escape_string($this->db->link, $level);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $minSalary = mysqli_real_escape_string($this->db->link, $minSalary);
        $maxSalary = mysqli_real_escape_string($this->db->link, $maxSalary);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $requireJob = mysqli_real_escape_string($this->db->link, $requireJob);
        $welfare = mysqli_real_escape_string($this->db->link, $welfare);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $categoryId = mysqli_real_escape_string($this->db->link, $categoryId);
        $companyId = mysqli_real_escape_string($this->db->link, $companyId);
        $deadline = mysqli_real_escape_string($this->db->link, $deadline);
        $language = mysqli_real_escape_string($this->db->link, $language);
        $time = mysqli_real_escape_string($this->db->link, $time);

        if (
            empty($title) || empty($typeOfCv) || empty($level) || empty($address) || empty($minSalary) || empty($maxSalary) || empty($description)
            || empty($requireJob) || empty($welfare) || empty($userId) || empty($categoryId) || empty($deadline) || empty($time)
        ) {
            $alert = "<span  style='color: red;'>Job info must be not empty!</span>";
            return $alert;
        } else {
            $query = "UPDATE `tbl_job` 
            SET `title`='$title',`type_of_cv`='$typeOfCv',
            `level`='$level',`address`='$address',`min_salary`='$minSalary',
            `max_salary`='$maxSalary',`description`='$description',`require_job`='$requireJob',
            `welfare`='$welfare',`language`='$language',
            `categoryId`='$categoryId',`deadline`='$deadline',`time`='$time', `companyId` = '$companyId'
            WHERE id = $id";

            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color: green;'>Update Job Successfully</span>";
                return $alert;
            } else {
                $alert = "<span style='color: red;'>Update Job Not Successfully</span>";
                return $alert;
            }
        }

    }

    public function approveForJob($id) {
        $query = "UPDATE `tbl_job` SET `is_approve`= b'1' WHERE id = $id";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Approve Job Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Approve Job Not Successfully</span>";
            return $alert;
        }
    }

    public function removeForJob($id) {
        $query = "UPDATE `tbl_job` SET `is_remove`= b'1' WHERE id = $id ";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color: green;'>Remove Job Successfully</span>";
            return $alert;
        } else {
            $alert = "<span style='color: red;'>Remove Job Not Successfully</span>";
            return $alert;
        }
    }

}

?>