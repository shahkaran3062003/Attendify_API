<?php

class Teacher
{
    // private attributes
    private $conn;
    private $table = "teacher";

    // public attributes

    public $id;
    public $name;
    public $email;
    public $contact;
    public $password;

    // constructor to init $conn
    public function __construct($DB)
    {
        $this->conn = $DB;
    }

    // reading all teachers from db;
    public function read_all()
    {
        $query = 'SELECT id, name,email,contact FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row != null) {
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->contact = $row['contct'];
            $this->password = $row['password'];
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET name = ?, email = ?, contact = ?, password = ?';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->email);
        $stmt->bindParam(3, $this->contact);
        $stmt->bindParam(4, $this->password);

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

    public function authenticate()
    {
        $query = "SELECT email, password FROM " . $this->table . " WHERE email = ? AND password = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        $total_count = $stmt->rowCount();

        if ($total_count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
