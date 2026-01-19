<?php
session_start();
include_once "../../Controller/authCheck.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if (!$isLoggedIn) {
    Header("Location: ../Auth/login.php");
}
$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";

include_once "../../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$connection = $db->openConnection();

$transactionsQuery = "
    SELECT t.transaction_id, t.booking_amount,t.full_price, t.payment_method, t.transaction_date, t.status,
           p.title AS property_title,
            b.full_name AS buyer_name, 
            a.full_name AS agent_name
    FROM transactions t
    LEFT JOIN properties p ON t.property_id = p.property_id
    LEFT JOIN buyers b ON t.user_id = b.user_id
    LEFT JOIN agents a ON t.agent_id = a.agent_id
    ORDER BY t.transaction_date DESC
";

$transactionsResult = $connection->query($transactionsQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transactions | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="../../Public/CSS/propertise.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body id="page-transactions">
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <header>
            <div class="header-title">
                <h1>Financial Transactions</h1>
            </div>
            <div class="user-wrapper">
                <i class="fa-duotone fa-solid fa-user user-img"></i>
                <div>
                    <h4><?php echo htmlspecialchars($username); ?>
                        <a href="Edit/editProfile.php" class="edit-profile-btn">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                    </h4>
                    <small><?php echo htmlspecialchars($email); ?></small>
                </div>
            </div>
        </header>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Property</td>
                        <td>Buyer</td>
                        <td>Agent</td>
                        <td>Booking Amount</td>
                        <td>Full Price</td>
                        <td>Payment Method</td>
                        <td>Transactions Date</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($transactionsResult && $transactionsResult->num_rows > 0) {
                        while ($row = $transactionsResult->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['transaction_id']; ?></td>
                                <td><?php echo $row['property_title']; ?></td>
                                <td><?php echo $row['buyer_name']; ?></td>
                                <td><?php echo $row['agent_name']; ?></td>
                                <td><?php echo number_format($row['booking_amount'], 2); ?></td>

                                <td><?php echo number_format($row['full_price'], 2); ?></td>
                                <td><?php echo $row['payment_method']; ?></td>

                                <td><?php echo $row['transaction_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a href="Edit/editTransaction.php?id=<?php echo $row['transaction_id']; ?>" class="edit-btn">Edit</a>

                                    <a href="../../Controller/deleteTransaction.php?id=<?php echo $row['transaction_id']; ?>" class="delete-btn">Delete</a>
                                    <?php if ($row['status'] !== 'Completed'): ?>

                                        <a href="../../Controller/approveTransaction.php?id=<?php echo $row['transaction_id']; ?>" class="approve-btn">Approve</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9">No transactions found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>