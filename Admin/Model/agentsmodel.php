<?php
class AgentModel
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
}
