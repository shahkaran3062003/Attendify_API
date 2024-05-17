<?php

class Attendance
{
    private $conn;
    private $table = "attendance";

    public $id;
    public $classId;
    public $studentId;
    public $date;
    public $startDate;
    public $endDate;
    public $status;


    public function __construct($DB)
    {
        $this->conn = $DB;
    }

    public function insert()
    {
        $query = "INSERT INTO " . $this->table . " SET class = ?, student = ?, status = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->classId);
        $stmt->bindParam(2, $this->studentId);
        // $stmt->bindParam(3, $this->date);
        $stmt->bindParam(3, $this->status);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkDate()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE class = ? AND date = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->classId);
        $stmt->bindParam(2, $this->date);
        $stmt->execute();
        $total_count = $stmt->rowCount();
        if ($total_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function readClassAttendanceByDate()
    {
        $query = "SELECT s.rollNo, s.name, a.date,a.status FROM " . $this->table . " a JOIN student s ON s.id = a.student WHERE a.class = ? AND a.date = ? ORDER BY s.rollNo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->classId);
        $stmt->bindParam(2, $this->date);
        $stmt->execute();
        return $stmt;
    }

    public function readClassAttendanceByStartEndDate()
    {
        $query = "SELECT s.rollNo, s.name, a.date,a.status FROM " . $this->table . " a JOIN student s ON s.id = a.student WHERE a.class = ? AND a.date  BETWEEN ? AND ? ORDER BY s.rollNo, a.date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->classId);
        $stmt->bindParam(2, $this->startDate);
        $stmt->bindParam(3, $this->endDate);
        $stmt->execute();
        return $stmt;
    }

    public function readStudentAttendanceByStartEndDate()
    {
        $query = "SELECT a.date, a.status FROM " . $this->table . " a JOIN student s ON s.id = a.student WHERE a.student = ? AND a.date BETWEEN ? AND ? ORDER BY s.rollNo, a.date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->studentId);
        $stmt->bindParam(2, $this->startDate);
        $stmt->bindParam(3, $this->endDate);
        $stmt->execute();
        return $stmt;
    }
}
