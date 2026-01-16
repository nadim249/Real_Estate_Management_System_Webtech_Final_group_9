<?php
session_start();
require_once "../../../Model/DatabaseConnection.php";

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header("Location: ../../Auth/login.php");
    exit;
}

// Get admin info
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$adminId = $_SESSION['admin_id'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile | EstateMgr</title>
    <link rel="stylesheet" href="../../../Public/CSS/update.css">
</head>
<body>

    <div class="update-container">
          <div class="update-header">
        <h2>Edit Profile</h2>
        </div>
        <form method="POST" action="../../../Controller/updates/updateAdmin.php" class="update-form">
            <input type="hidden" name="admin_id" value="<?php echo $adminId; ?>">
            
            <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>

            <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
            <label>New Password <small>(leave blank to keep current)</small></label>
            <input type="password" name="password">
            </div>

            <div class="update-actions">
            <button type="submit" class="btn-save">Update Profile</button>
            <a href="../users.php" class="btn-cancel">Cancel</a>
            </div>
    </form>
    </div>
</body>
</html>
