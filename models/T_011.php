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
}
