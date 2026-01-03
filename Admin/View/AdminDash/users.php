<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body id="page-users">
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
                <a href="#"><i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <main class="main-content">
        <header><div class="header-title"><h1>Registered Users</h1></div></header>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr><td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Joined</td><td>Action</td></tr></thead><tbody id="users-list"></tbody></table>
        </div>
    </main>

</body>
</html>