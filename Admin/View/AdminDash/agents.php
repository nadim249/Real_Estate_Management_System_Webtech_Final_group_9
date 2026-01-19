<?php
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
if (!$isLoggedIn) {
    Header("Location: login.php");
}
$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";

include "../../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$connection = $db->openConnection();

$agentsQuery = "SELECT * FROM agents ORDER BY created_at ASC";
$agentsResult = $connection->query($agentsQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Agents | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="../../Public/CSS/propertise.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body id="page-agents">
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <header>
            <div class="header-title">
                <h1>Our Agents</h1>
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
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search..." />
            </div>
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Commission Rate</td>
                        <td>Total Sales</td>
                        <td>Rating</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    if ($agentsResult && $agentsResult->num_rows > 0) {
                        while ($row = $agentsResult->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['agent_id']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['commission_rate']; ?></td>
                                <td><?php echo $row['total_sales']; ?></td>
                                <td><?php echo $row['rating']; ?></td>


                                <td>
                                    <a href="Edit/editAgent.php?id=<?php echo $row['agent_id']; ?>" class="edit-btn">Edit</a>
                                    <a href="../../Controller/Deletes/deleteAgent.php?id=<?php echo $row['agent_id']; ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this agent?');">
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
        </div>

    </main>

    <script src="../../Controller/JS/searchagent.js"></script>


</body>

</html>