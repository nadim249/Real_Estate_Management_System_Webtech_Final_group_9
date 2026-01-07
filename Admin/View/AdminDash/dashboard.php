<?php
session_start();
include "../../Controller/dashboardcardCount.php";

$isLoggedIn= $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
}
$email = $_SESSION["email"] ??"";
$username = $_SESSION["username"] ??"";


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
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-building fa-2x"></i>
            <h2><a href="dashboard.php">
            EstateMgr</h2>
        </div>
        <ul class="menu">
            <li>
                <a href="dashboard.php">
                    <i class="fa-solid fa-gauge"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="propertiesdata.php">
                    <i class="fa-solid fa-house"></i> 
                    <span>Properties</span>
                </a>
            </li>
            <li>
                <a href="approvals.php">
                    <i class="fa-solid fa-clipboard-check"></i>
                     <span>Approvals</span>
                    </a>
            </li>
            <li>
                <a href="transactions.php">
                    <i class="fa-solid fa-money-bill-wave"></i> 
                    <span>Transactions</span>
                </a>
            </li>
            <li>
                <a href="agents.php">
                    <i class="fa-solid fa-user-tie"></i> 
                    <span>Agents</span>
                </a>
            </li>
            <li>
                <a href="users.php">
                    <i class="fa-solid fa-users"></i> 
                    <span>Users</span>
                </a>
            </li>
            <li class="logout-btn">
                <a href="../../Controller/logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <main class="main-content">
        <header>
            <div class="header-title">
                <h1>Dashboard Overview</h1>
            </div>
                <div class="user-wrapper">
                    <i class="fa-duotone fa-solid fa-user user-img"></i>
                    <div>
                    <h4><?php echo htmlspecialchars($username); ?></h4>
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
                <tbody id="property-body">
                    <tr>
                        <td>Dhanmodi house</td>
                        <td>32000000</td>
                        <td><span class="status"></span>sale</td>
                        <td>Rijon</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </main>
</body>
</html>