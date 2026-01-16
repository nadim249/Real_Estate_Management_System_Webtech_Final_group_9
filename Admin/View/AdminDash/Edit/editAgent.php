<?php
session_start();
include "../../../Model/DatabaseConnection.php";

if(!isset($_GET['id'])) {
    header("Location: ../agents.php");
    exit;
}

$agentId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM agents WHERE agent_id = $agentId";
$result = $conn->query($sql);

if($result->num_rows === 0){
    echo "Agent not found!";
    exit;
}

$agent = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Agent</title>
    <link rel="stylesheet" href="../../../Public/CSS/update.css">
</head>
<body>
    <div class="update-container">
    
  <div class="update-header">
        <h2>Edit Agent</h2>
        </div>

        <form method="POST" action="../../../Controller/updates/updateAgent.php" class="update-form">
            <input type="hidden" name="agent_id" value="<?php echo $agent['agent_id']; ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($agent['full_name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($agent['email']); ?>" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($agent['phone']); ?>" required>
            </div>

            <div class="form-group">
                <label>Commission (%)</label>
                <input type="number" step="0.01" name="commission" 
                       value="<?php echo htmlspecialchars($agent['commission_rate']); ?>" required>
            </div>

                <div class="update-actions">

    <button type="submit" class="btn-save">Update Agent</button>
     <a href="../agents.php" class="btn-cancel">Cancel</a>
</div>
    </form>
    </div>
</body>
</html>
