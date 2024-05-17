<?php
class Classes
{
    private $conn;
    private $table = 'classes';

    public $id;
    public $name;
    public $sem;
    public $branch;
    public $port;

    public function __construct($DB)
    {
        $this->conn = $DB;
    }

    public function read_all()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " SET name = ?, sem = ?, branch = ?, port = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->sem);
        $stmt->bindParam(3, $this->branch);
        $stmt->bindParam(4, $this->port);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPort()
    {
        $query = "SELECT port FROM " . $this->table . " WHERE port = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->port);
        $stmt->execute();
        $total_count = $stmt->rowCount();
        if ($total_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET name = ?, sem = ?, branch = ?, port = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->sem);
        $stmt->bindParam(3, $this->branch);
        $stmt->bindParam(4, $this->port);
        $stmt->bindParam(5, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUpdatePort()
    {
        $query = "SELECT port FROM " . $this->table . " WHERE port = ? AND NOT id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->port);
        $stmt->bindParam(2, $this->id);
        $stmt->execute();
        $total_count = $stmt->rowCount();
        if ($total_count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function readAllStudent()
    {
        $query = "SELECT id, profilePic, name, rollNo, email, contact FROM student WHERE class = ? ORDER BY rollNo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }
}
