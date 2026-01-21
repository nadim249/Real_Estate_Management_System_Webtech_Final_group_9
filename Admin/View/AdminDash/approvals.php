<?php
include_once "../../Controller/approvalsController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Approvals | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <link rel="stylesheet" href="../../Public/CSS/propertise.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body id="page-approvals">
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    ?>
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
        <header>
            <div class="header-title">
                <h1>Pending Approvals</h1>
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
                        <td>Type</td>
                        <td>Agent</td>
                        <td>Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody id="approvals-list">
                    <?php
                    if ($approvalsResult && $approvalsResult->num_rows > 0) {
                        while ($row = $approvalsResult->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row['property_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['agent_name'] ?? 'N/A'); ?></td>
                                <td><?php echo date("Y-m-d", strtotime($row['created_at'])); ?></td>
                                <td>
                                    <a href="../../Controller/approveProperty.php?id=<?php echo $row['property_id']; ?>"
                                        class="edit-btn">Approve</a>

                                    <a href="../../Controller/rejectProperty.php?id=<?php echo $row['property_id']; ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Reject this property?');">
                                        Reject
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="6">No pending approvals found.</td></tr>';
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </main>

</body>

</html>