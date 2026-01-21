<?php
class PropertiseModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAllAgents()
    {
        $sql = "SELECT * FROM agents ORDER BY created_at ASC";
        return $this->conn->query($sql);
    }

        function getAllProperties()
    {
        $sql = "SELECT * FROM properties ORDER BY created_at DESC";
        return $this->conn->query($sql);
    }
}
