<div class="sidebar">
    <div class="logo">
        <i class="fa-solid fa-building fa-2x"></i>
        <h2><a href="dashboard.php">EstateMgr</a></h2>
    </div>
    <ul class="menu">

        <li>
            <a href="dashboard.php" class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="propertiesdata.php" class="<?= $currentPage == 'propertiesdata.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-house"></i>
                <span>Properties</span>
            </a>
        </li>
        <li>
            <a href="approvals.php" class="<?= $currentPage == 'approvals.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-clipboard-check"></i>
                <span>Approvals</span>
            </a>
        </li>
        <li>
            <a href="transactions.php" class="<?= $currentPage == 'transactions.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li>
            <a href="agents.php" class="<?= $currentPage == 'agents.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-user-tie"></i>
                <span>Agents</span>
            </a>
        </li>
        <li>
            <a href="users.php" class="<?= $currentPage == 'users.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="logout-btn">
            <a href="../../Controller/logout.php" class="no-hover">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>