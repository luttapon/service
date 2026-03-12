<?php

class T_011
{
    private $connDB;


    public $id;
    public $taskName;
    public $taskDetail;
    public $taskStatus;
    public $createAt;

    public $msg;
    // Constructor to initialize the properties
    public function __construct($connDB)
    {
        $this->connDB = $connDB;
    }
    // Method to fetch all tasks from the database
    public function getAllTasks()
    {

        $query = "SELECT * FROM T_011_tb ORDER BY createAt DESC";
        $stmt = $this->connDB->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function gettaskByName($taskName)
    {
        $query = "SELECT * FROM T_011_tb WHERE taskName LIKE :taskName ORDER BY createAt DESC";
        $taskName = "%" . htmlspecialchars(strip_tags($taskName)) . "%";
        $stmt = $this->connDB->prepare($query);
        $stmt->bindParam(':taskName', $taskName);
        $stmt->execute();
        return $stmt;
    }

    // ฟังชันสำหรับค้นหาข้อมูลโดยใช้ taskDetail และ taskStatus (โดยที่ taskStatus ต้องเป็น 1 )
    public function gettaskByDetailAndStatus($taskDetail)
    {
        $query = "SELECT * FROM T_011_tb WHERE taskDetail LIKE :taskDetail AND taskStatus = 1 ORDER BY createAt DESC";
        $taskDetail = "%" . htmlspecialchars(strip_tags($taskDetail)) . "%";
        $stmt = $this->connDB->prepare($query);
        $stmt->bindParam(':taskDetail', $taskDetail);
        $stmt->execute();
        return $stmt;
    }

    // ฟังชั่นเพิ่มข้อมูลใหม่ลงในตาราง
    public function addTask($taskName, $taskDetail, $taskStatus)
    {
        $query = "INSERT INTO T_011_tb (taskName, taskDetail, taskStatus) VALUES (:taskName, :taskDetail, :taskStatus)";
        $taskName = htmlspecialchars(strip_tags($taskName));
        $taskDetail = htmlspecialchars(strip_tags($taskDetail));
        $taskStatus = htmlspecialchars(strip_tags($taskStatus));
        $stmt = $this->connDB->prepare($query);

        $stmt->bindParam(':taskName', $taskName);
        $stmt->bindParam(':taskDetail', $taskDetail);
        $stmt->bindParam(':taskStatus', $taskStatus);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // ฟังชั่นสำหรับอัพเดตสถานะของงาน
    public function updateTaskbyId($id, $taskName, $taskDetail, $taskStatus)
    {
        $query = "UPDATE T_011_tb SET taskName = :taskName, taskDetail = :taskDetail, taskStatus = :taskStatus WHERE id = :id";
        $taskName = htmlspecialchars(strip_tags($taskName));
        $taskDetail = htmlspecialchars(strip_tags($taskDetail));
        $taskStatus = intval(htmlspecialchars(strip_tags($taskStatus)));
        $id = intval(htmlspecialchars(strip_tags($id)));

        $stmt = $this->connDB->prepare($query);

        $stmt->bindParam(':taskName', $taskName);
        $stmt->bindParam(':taskDetail', $taskDetail);
        $stmt->bindParam(':taskStatus', $taskStatus);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
    // ฟังชั่นสำหรับลบงาน
    public function deleteTaskbyId($id)
    {
        $query = "DELETE FROM T_011_tb WHERE id = :id";
        $id = intval(htmlspecialchars(strip_tags($id)));
        $stmt = $this->connDB->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
