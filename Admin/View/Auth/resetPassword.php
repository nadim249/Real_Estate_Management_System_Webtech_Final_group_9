<?php
session_start();
if (!isset($_SESSION['verified'])) {
    header("Location: login.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/CSS/styles.css">

    <title>Que Verify</title>
</head>

<body id="page-signup">
    <div class="signup-card">
        <form method="post" action="../../Controller/updates/updatePassword.php">
            <div class="form-group">

                <label>New Password</label>
                <input type="password" name="password" class="signup-input" required>
            </div>

            <div class="form-group">

                <label>Confirm Password</label>
                <input type="password" name="confirm" class="signup-input">

            </div>
            <div class="form-group">
                <?php
                if (isset($_GET['success'])) {
                    echo "<p class='success'>Password reset successful!</p>";
                }

                if (isset($_GET['error']) && $_GET['error'] === 'nomatch') {
                    echo "<p class='errSpan'>Passwords do not match!</p>";
                }
                ?>
            </div>
            <button type="submit" class="signup-btn">Reset</button>
        </form>

    </div>
</body>

</html>