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

       public function hasProperties($agentId)
    {
        $stmt = $this->conn->prepare(
            "SELECT agent_id FROM properties WHERE agent_id = ?"
        );
        $stmt->bind_param("i", $agentId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

public function deleteAgent($agentId)
{
    $tables = ['properties', 'inquiries', 'transactions','viewings'];

    foreach ($tables as $table) {
        $stmt = $this->conn->prepare(
            "UPDATE $table SET agent_id = NULL WHERE agent_id = ?"
        );
        $stmt->bind_param("i", $agentId);
        $stmt->execute();
    }

    $stmt = $this->conn->prepare(
        "DELETE FROM agents WHERE agent_id = ?"
    );
    $stmt->bind_param("i", $agentId);
    return $stmt->execute();
}



}
