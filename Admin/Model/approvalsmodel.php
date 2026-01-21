<?php
class ApproveModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

          function getPendingApprovals()
    {
        $sql = "
            SELECT p.property_id, p.title, p.type, p.created_at,
                   a.full_name AS agent_name
            FROM properties p
            LEFT JOIN agents a ON p.agent_id = a.agent_id
            WHERE p.status = 'Pending'
            ORDER BY p.created_at DESC
        ";
        return $this->conn->query($sql);
    }
}
