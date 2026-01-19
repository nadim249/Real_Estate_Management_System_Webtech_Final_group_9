<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: properties.php"); 
    exit;
}
$propertyId = (int)$_GET['id'];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("SELECT property_id, title, location, description, type, area_sqft, num_bedrooms, num_bathrooms, price, image_url
                        FROM properties
                        WHERE property_id = ?");
$stmt->bind_param("i", $propertyId);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows !== 1) {
    header("Location: properties.php");
    exit;
}

$property = $result->fetch_assoc();

$img = !empty($property['image_url'])
    ? $property['image_url']
    : "uploads/vill_banani.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Property Details</title>
  <link rel="stylesheet" href="../Public/css/style3.css" />
  <link rel="stylesheet" href="../Public/css/style6.css" />
    <link rel="stylesheet" href="../Public/css/style2.css" />

</head>
<body>

<?php 
if ($isLoggedIn) {
    include 'navloged.php';
} else {
    include 'nav.php';
}
?>

<div class="page">

  <div class="top">
    <h1 class="main-title"><?php echo htmlspecialchars($property['title']); ?></h1>
    <p class="sub-title"><?php echo htmlspecialchars($property['location']); ?></p>
  </div>

  <div class="layout">

    <div class="left">

      <div class="card">
        <img class="hero-img" src="<?php echo htmlspecialchars($img); ?>" alt="Property image" />
      </div>

      <div class="info-row card">
        <div class="info-item">
          <div class="info-value"><?php echo htmlspecialchars($property['type']); ?></div>
          <div class="info-label">Type</div>
        </div>

        <div class="info-item">
          <div class="info-value"><?php echo number_format((float)$property['area_sqft']); ?></div>
          <div class="info-label">Sqft</div>
        </div>

        <div class="info-item">
          <div class="info-value"><?php echo (int)$property['num_bedrooms']; ?></div>
          <div class="info-label">Bedrooms</div>
        </div>

        <div class="info-item">
          <div class="info-value"><?php echo (int)$property['num_bathrooms']; ?></div>
          <div class="info-label">Bathrooms</div>
        </div>
      </div>

      <div class="card description">
        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
      </div>

    </div>

    <div class="right">

      <div class="card panel">
        <h3 class="panel-title">Schedule a Viewing</h3>
          <?php if(!$isLoggedIn): ?>
    <p style="margin:10px 0;">Please login to request a viewing.</p>
    <a class="btn btn-blue" href="login.php">Login</a>
  <?php else: ?>
    <form method="GET" action="../Controller/scheduleview.php">

      <input type="hidden" name="property_id" value="<?php echo (int)$property['property_id']; ?>">

      <label class="label">Select Date</label>
      <input class="input" type="date" name="schedule_date" required>

      <label class="label">Select Time</label>
      <input class="input" type="time" name="schedule_time" required>

      <label class="label">Note (Optional)</label>
      <input class="input" type="text" name="buyer_note" placeholder="I am free only on weekends.">

  <button type="submit" class="btn btn-blue">Request Visit</button>
    </form>
            <?php endif; ?>
      </div>

      <div class="card panel">
        <h3 class="panel-title">Inquiry to Agent</h3>

        <label class="label">Your Message</label>
        <textarea class="textarea" placeholder="Is the price negotiable?"></textarea>

        <button class="btn btn-dark">Send Message</button>
      </div>

      <div class="card panel buy">
        <h3 class="panel-title">Ready to Buy?</h3>

        <div class="big-price"><?php echo number_format((float)$property['price']); ?> BDT</div>
        <p class="small">
          Secure this property now by paying the booking token amount.
        </p>

        <label class="label">Booking Amount (Token)</label>
        <input class="input" type="number" value="500000" />

        <button class="btn btn-green">Book Now</button>
      </div>

    </div>

  </div>
</div>

</body>
</html>
