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

$buyersQuery = "SELECT * FROM buyers ORDER BY created_at ASC";
$buyersResult = $connection->query($buyersQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
            <link rel="stylesheet" href="../../Public/CSS/propertise.css">

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
                <a href="../../Controller/logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span></a>
            </li>
        </ul>
    </div>
    <main class="main-content">
        <header><div class="header-title"><h1>Registered Users</h1></div>
                        <div class="user-wrapper">
                    <i class="fa-duotone fa-solid fa-user user-img"></i>
                    <div>
                    <h4><?php echo htmlspecialchars($username); ?></h4>
                    <small><?php echo htmlspecialchars($email); ?></small>
                    </div>
                </div>
    </header>
<div class="table-responsive">
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
    <p style="color: green;">User updated successfully!</p>
    <?php endif; ?>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <p style="color: green;">User deleted successfully!</p>
<?php endif; ?>

    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Full Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Created At</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if($buyersResult->num_rows > 0){
                while($row = $buyersResult->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="editUser.php?id=<?php echo $row['user_id']; ?>" class="edit-btn">Edit</a>
                                <a href="../../Controller/deleteUser.php?id=<?php echo $row['user_id']; ?>"
       class="delete-btn"
       onclick="return confirm('Are you sure you want to delete this user?');">
       Delete
    </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6">No agents found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
    </main>

</body>
</html>