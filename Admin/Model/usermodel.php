<?php
class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

      function getAllBuyers()
    {
        $sql = "SELECT * FROM buyers ORDER BY created_at ASC";
        $result = $this->conn->query($sql);
        return $result;
    }
}
