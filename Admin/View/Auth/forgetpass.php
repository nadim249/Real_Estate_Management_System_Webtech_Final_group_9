<?php

session_start();
include "../../Model/DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    $stmt = $conn->prepare(
        "SELECT admin_id, security_question FROM admins WHERE email=? OR username=?"
    );
    $stmt->bind_param("ss", $user, $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        $_SESSION['reset_id'] = $row['admin_id'];
        $_SESSION['sec_q'] = $row['security_question'];

        header("Location: verifyQuestion.php");
        exit;
    } else {
        echo "User not found!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/CSS/styles.css">

    <title>forgetpass</title>
</head>

<body id="page-signup">
    <div class="signup-card">
        <form method="post">
            <div class="form-group">

                <label>Email or Username</label>

                <input type="text" class="signup-input" name="user" required>
                <button type="submit" class="signup-btn">Next</button>
                <?php if(isset($error)) echo "<p class='errSpan'>$error</p>"; ?>

            </div>
        </form>
    </div>

</body>

</html>