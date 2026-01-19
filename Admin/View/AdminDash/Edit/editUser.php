<?php
session_start();
require_once "../../../Model/DatabaseConnection.php";

if (!isset($_GET['id'])) {
  header("Location: ../users.php");
  exit;
}

$userId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM buyers WHERE user_id = $userId";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
  header("Location: ../users.php");
  exit;
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit User</title>
  <link rel="stylesheet" href="../../../Public/CSS/update.css">

</head>

<body>

  <div class="update-container">

    <div class="update-header">
      <h2>Edit User</h2>
      <p>Update buyer information</p>
    </div>

    <form method="POST" action="../../../Controller/updates/updateUser.php" class="update-form">

      <!-- Hidden ID -->
      <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

      <!-- Full Name -->
      <div class="form-group">
        <label>Full Name</label>
        <input type="text"
          name="full_name"
          value="<?php echo htmlspecialchars($user['full_name']); ?>"
          required>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label>Email Address</label>
        <input type="email"
          name="email"
          value="<?php echo htmlspecialchars($user['email']); ?>"
          required>
      </div>

      <!-- Phone -->
      <div class="form-group">
        <label>Phone Number</label>
        <input type="text"
          name="phone"
          value="<?php echo htmlspecialchars($user['phone']); ?>"
          required>
      </div>

      <!-- Optional: Update Password -->
      <div class="form-group">
        <label>New Password <small>(leave blank to keep unchanged)</small></label>
        <input type="password" name="password">
      </div>

      <!-- Actions -->
      <div class="update-actions">
        <button type="submit" class="btn-save">Update User</button>
        <a href="../users.php" class="btn-cancel">Cancel</a>
      </div>

    </form>
  </div>

</body>

</html>