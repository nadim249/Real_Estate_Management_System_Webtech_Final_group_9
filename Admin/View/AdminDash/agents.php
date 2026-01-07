<?php
session_start();

$isLoggedIn= $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
}
$email = $_SESSION["email"] ??"";
$username = $_SESSION["username"] ??"";


include "../../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$connection = $db->openConnection();

$propertiesQuery = "SELECT * FROM agents ORDER BY created_at DESC";
$propertiesResult = $connection->query($propertiesQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agents | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body id="page-agents">
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
                <h1>Our Agents</h1>
            </div>
                            <div class="user-wrapper">
                    <i class="fa-duotone fa-solid fa-user user-img"></i>
                    <div>
                    <h4><?php echo htmlspecialchars($username); ?></h4>
                    <small><?php echo htmlspecialchars($email); ?></small>
                    </div>
                </div>
        </header>
        <div class="agent-grid-container" id="agents-grid"></div>
    </main>

</body>
</html>