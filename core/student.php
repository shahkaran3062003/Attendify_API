<?php

class Student
{

    private $conn;
    private $table = 'student';

    public $id;
    public $profilePic;
    public $name;
    public $rollNo;
    public $email;
    public $contact;
    public $password;
    public $mac;
    public $imei;
    public $classId;


    public function __construct($DB)
    {
        $this->conn = $DB;
    }

    public function authenticate()
    {
        $query = "SELECT id, email, password, mac, imei FROM " . $this->table . " WHERE email = ? AND password = ? AND ( mac = ? OR imei = ? )";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->mac);
        $stmt->bindParam(4, $this->imei);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_count = $stmt->rowCount();

        if ($total_count > 0) {
            $this->id = $result['id'];
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET profilePic = ?, name = ?, rollNo = ?, email = ?, contact = ?, password = ?, mac = ?, imei = ?, class = ?';
        $stmt = $this->conn->prepare($query);

        $this->profilePic = htmlspecialchars(strip_tags($this->profilePic));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->mac = htmlspecialchars(strip_tags($this->mac));
        $this->imei = htmlspecialchars(strip_tags($this->imei));
        $this->classId = htmlspecialchars(strip_tags($this->classId));

        $stmt->bindParam(1, $this->profilePic);
        $stmt->bindParam(2, $this->name);
        $stmt->bindParam(3, $this->rollNo);
        $stmt->bindParam(4, $this->email);
        $stmt->bindParam(5, $this->contact);
        $stmt->bindParam(6, $this->password);
        $stmt->bindParam(7, $this->mac);
        $stmt->bindParam(8, $this->imei);
        $stmt->bindParam(9, $this->classId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail()
    {
        $query = "SELECT email FROM " . $this->table . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $total_count = $stmt->rowCount();

        if ($total_count > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function readAllStudentOfClass()
    {
        $query = "SELECT id, profilePic, name, rollNo, email, contact FROM " . $this->table . " WHERE class = ( SELECT class FROM " . $this->table . " WHERE id = ? ) ORDER BY rollNo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }
}
