<?php
session_start();
include_once "../../Model/DatabaseConnection.php";
include "../../Controller/dashboardcardCount.php";
include_once "../../Controller/authCheck.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if (!$isLoggedIn) {
    Header("Location: ../Auth/login.php");
}
$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";



$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT p.title, p.price, p.status, a.full_name AS agent_name
        FROM properties p
        LEFT JOIN agents a ON p.agent_id = a.agent_id
        ORDER BY p.created_at DESC
        LIMIT 5";

$recentProperties = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Dashboard</title>
</head>

<body id="page-dashboard">
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <header>
            <div class="header-title">
                <h1>Dashboard Overview</h1>
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

        <div class="cards-grid" id="stats-container">

            <!-- Total Users -->
            <div class="single-card">
                <div>
                    <h1><?php echo $totalUsers; ?></h1>
                    <span>Total Users</span>
                </div>
                <div>
                    <span class="fa-solid fa-users" id="logo-card"></span>
                </div>
            </div>

            <!-- Total Properties -->
            <div class="single-card">
                <div>
                    <h1><?php echo $totalProperties; ?></h1>
                    <span>Total Properties</span>
                </div>
                <div>
                    <span class="fa-solid fa-house" id="logo-card"></span>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="single-card">
                <div>
                    <h1><?php echo $pendingApprovals; ?></h1>
                    <span>Pending Approvals</span>
                </div>
                <div>
                    <span class="fa-solid fa-clock" id="logo-card"></span>
                </div>
            </div>

            <!-- Total Sold -->
            <div class="single-card">
                <div>
                    <h1><?php echo $totalSoldThisMonth; ?></h1>
                    <span> Sold(This Month)</span>
                </div>
                <div>
                    <span class="fa-solid fa-hand-holding-dollar" id="logo-card"></span>
                </div>
            </div>

        </div>


        <div class="table-responsive">
            <h3>Recent Listings</h3>
            <table>
                <thead>
                    <tr>
                        <td>Property Title</td>
                        <td>Price</td>
                        <td>Status</td>
                        <td>Agent</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($recentProperties && $recentProperties->num_rows > 0): ?>
                        <?php while ($row = $recentProperties->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo number_format($row['price'], 2); ?></td>
                                <td>
                                    <span class="status">
                                        <?php echo htmlspecialchars($row['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['agent_name'] ?? 'N/A'); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No recent listings found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </main>
</body>

</html>