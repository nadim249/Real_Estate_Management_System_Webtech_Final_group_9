<?php
class TransactoionModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAllTransactions()
    {
        $sql = "
            SELECT t.transaction_id, t.booking_amount, t.full_price, t.payment_method, t.transaction_date, t.status,
                   p.title AS property_title,
                   b.full_name AS buyer_name, 
                   a.full_name AS agent_name
            FROM transactions t
            LEFT JOIN properties p ON t.property_id = p.property_id
            LEFT JOIN buyers b ON t.user_id = b.user_id
            LEFT JOIN agents a ON t.agent_id = a.agent_id
            ORDER BY t.transaction_date DESC
        ";
        return $this->conn->query($sql);
    }

        public function deleteTransaction($transactionId)
    {
        $stmt = $this->conn->prepare("DELETE FROM transactions WHERE transaction_id = ?");
        $stmt->bind_param("i", $transactionId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function exists($transactionId)
    {
        $stmt = $this->conn->prepare("SELECT transaction_id FROM transactions WHERE transaction_id = ?");
        $stmt->bind_param("i", $transactionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }
}
