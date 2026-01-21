<?php
class PropertiseModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

  

        function getAllProperties()
    {
        $sql = "SELECT * FROM properties ORDER BY created_at DESC";
        return $this->conn->query($sql);
    }

       public function deleteProperty($propertyId)
    {
        $stmt = $this->conn->prepare("DELETE FROM properties WHERE property_id = ?");
        $stmt->bind_param("i", $propertyId);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function exists($propertyId)
    {
        $stmt = $this->conn->prepare("SELECT property_id FROM properties WHERE property_id = ?");
        $stmt->bind_param("i", $propertyId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }
}
