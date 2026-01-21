<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;
$userId = $_SESSION["user_id"] ?? null;

if(!$isLoggedIn || !$userId){
  header("Location: login.php");
  exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("SELECT user_id, full_name, email, phone FROM buyers WHERE user_id=?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

if(!$res || $res->num_rows !== 1){
  header("Location: dashboard.php");
  exit;
}
$user = $res->fetch_assoc();

$userViews = $db->getUserViews($userId);
$userTransactions = $db->getUserTransactions($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile</title>
  <link rel="stylesheet" href="../Public/css/style6.css" />
    <link rel="stylesheet" href="../Public/css/profile.css" />
</head>
<body>

<?php include 'navloged.php'; ?>

<div class="wrap">
  <div class="card">
    <h2 style="margin:0 0 14px;">My Profile</h2>
    <form method="POST" action="../Controller/profile_update.php">

    <div class="row">
      <div>
        <label class="lbl">Name</label>
        <input class="inp" type="text" name="name" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" >
      </div>
      <div>
        <label class="lbl">Email</label>
        <input class="inp" name="email" type="text" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" >
      </div>
    </div>

    <div class="row">
      <div>
        <label class="lbl">Phone</label>
        <input class="inp" name="phone" type="text" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" >
      </div>
    </div>

      <div class="actions">
        <button type="submit" class="btn btn-blue">Update</button>
        <a href="dashboard.php" class="btn btn-gray">Cancel</a>
      </div>
        </form>
  </div>
</div>
<div class="card">
    <h3>User Views</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Property ID</th>
          <th>Agent ID</th>
          <th>Schedule Date</th>
          <th>Status</th>
          <th>Buyer Note</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userViews as $view): ?>
        <tr>
          <td><?php echo $view['property_id']; ?></td>
          <td><?php echo $view['agent_id']; ?></td>
          <td><?php echo $view['schedule_date']; ?></td>
          <td><?php echo $view['status']; ?></td>
          <td><?php echo $view['buyer_note']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  
  <div class="card">
    <h3>User Transactions</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Property ID</th>
          <th>Booking Amount</th>
          <th>Full Price</th>
          <th>Payment Method</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userTransactions as $transaction): ?>
        <tr>
          <td><?php echo $transaction['transaction_id']; ?></td>
          <td><?php echo $transaction['property_id']; ?></td>
          <td><?php echo number_format((float)$transaction['booking_amount']); ?> BDT</td>
          <td><?php echo number_format((float)$transaction['full_price']); ?> BDT</td>
          <td><?php echo $transaction['payment_method']; ?></td>
          <td><?php echo $transaction['status']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>


</body>
</html>
