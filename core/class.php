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
}
