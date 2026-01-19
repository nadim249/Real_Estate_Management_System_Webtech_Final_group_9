<?php 
session_start(); 
include "../../Model/DatabaseConnection.php";


if (!isset($_SESSION['sec_q'], $_SESSION['reset_id'])) {
    header("Location: forgotpass.php");
    exit;
}
    $db = new DatabaseConnection();
$conn = $db->openConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = $_POST['answer'];

    $stmt = $conn->prepare(
      "SELECT security_answer FROM admins WHERE admin_id=?"
    );
    $stmt->bind_param("i", $_SESSION['reset_id']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    if($row &&  strcasecmp(trim($answer), trim($row['security_answer'])) === 0){
        $_SESSION['verified'] = true;
        header("Location: resetPassword.php");
        exit;
    } else {
        echo "Wrong answer!";
    }
}
$questions = [
    "pet" => "What is your pet name?",
    "color" => "What is your favorite color?",
    "school" => "What is your first school name?"
];

$questionText = $questions[$_SESSION['sec_q']] ?? "Security question not found.";
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

<form method="post">

<div class="form-group">
        <p><?php echo $questionText; ?></p>

</div>
<div class="form-group">
    <input type="text" class="signup-input" name="answer" required>
</div>
    <button type="submit" class="signup-btn">Verify</button>
        <?php if(isset($error)) echo "<p class='errSpan'>$error</p>"; ?>

</form>

</div>
</body>
</html>