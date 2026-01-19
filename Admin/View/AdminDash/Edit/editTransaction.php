<?php
session_start();
include "../../../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if (!$isLoggedIn) {
    header("Location: ../../Auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: ../transactions.php");
    exit;
}

$transactionId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

// Fetch transaction data
$sql = "SELECT t.*, p.title AS property_title, u.full_name AS user_name, a.full_name AS agent_name
        FROM transactions t
        LEFT JOIN properties p ON t.property_id = p.property_id
        LEFT JOIN buyers u ON t.user_id = u.user_id
        LEFT JOIN agents a ON t.agent_id = a.agent_id
        WHERE t.transaction_id = $transactionId";

$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "Transaction not found!";
    exit;
}

$transaction = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Transaction | EstateMgr</title>
    <link rel="stylesheet" href="../../../Public/CSS/update.css">
</head>

<body>
    <div class="update-container">
        <div class="update-header">
            <h2>Edit Transaction</h2>
        </div>

        <form method="POST" action="../../../Controller/updates/updateTransaction.php" class="update-form">
            <input type="hidden" name="transaction_id" value="<?php echo $transaction['transaction_id']; ?>">

            <div class="form-group">
                <label>Property</label>
                <input type="text" value="<?php echo htmlspecialchars($transaction['property_title']); ?>" disabled>
            </div>

            <div class="form-group">
                <label>User</label>
                <input type="text" value="<?php echo htmlspecialchars($transaction['user_name']); ?>" disabled>
            </div>

            <div class="form-group">
                <label>Agent</label>
                <input type="text" value="<?php echo htmlspecialchars($transaction['agent_name']); ?>" disabled>
            </div>

            <div class="form-group">
                <label>Booking Amount</label>
                <input type="number" step="0.01" name="booking_amount" value="<?php echo $transaction['booking_amount']; ?>" required>
            </div>

            <div class="form-group">
                <label>Full Price</label>
                <input type="number" step="0.01" name="full_price" value="<?php echo $transaction['full_price']; ?>" required>
            </div>

            <div class="form-group">
                <label>Payment Method</label>
                <select name="payment_method" required>
                    <option value="Bank Transfer" <?php echo $transaction['payment_method'] == 'Bank Transfer' ? 'selected' : ''; ?>>Bank Transfer</option>
                    <option value="Cash" <?php echo $transaction['payment_method'] == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                    <option value="Online Payment" <?php echo $transaction['payment_method'] == 'Online Payment' ? 'selected' : ''; ?>>Online Payment</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Pending_Agent" <?php echo $transaction['status'] == 'Pending_Agent' ? 'selected' : ''; ?>>Pending by Agent</option>
                    <option value="Pending_Admin" <?php echo $transaction['status'] == 'Pending_Admin' ? 'selected' : ''; ?>>Pending by Admin</option>
                    <option value="Completed" <?php echo $transaction['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>

            <div class="update-actions">

                <button type="submit" class="btn-save">Update Transaction</button>
                <a href="../transactions.php" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>