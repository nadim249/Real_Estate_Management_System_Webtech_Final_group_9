<?php
class UserModel
{
    private $conn;
 private $table = "buyers";
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

     public function deleteUser($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function exists($userId)
    {
        $stmt = $this->conn->prepare("SELECT user_id FROM $this->table WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }
}
