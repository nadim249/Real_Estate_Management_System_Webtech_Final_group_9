<?php
session_start();

$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

require_once "../Model/DatabaseConnection.php";

$db = new DatabaseConnection();
$properties = $db->getActiveProperties();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Available Properties</title>
  <link rel="stylesheet" href="../Public/css/style2.css" />
  <link rel="stylesheet" href="../Public/css/style6.css" />
</head>
<body>

<?php 
if ($isLoggedIn) {
    include 'navloged.php';
} else {
    include 'nav.php';
}
?>

<section class="section">
  <div class="heading">
    <h1>Available Properties</h1>
    <div class="line"></div>
  </div>

  <div class="grid">
    <?php if ($properties && count($properties) > 0): ?>
      <?php foreach($properties as $row): ?>
        <?php
          $img = !empty($row['image_url'])
            ? $row['image_url']
            : "https://images.unsplash.com/photo-1564013799919-ab600027ffc6?q=80&w=1200&auto=format&fit=crop";

          $badgeText = "Featured";
          $badgeClass = "sale"; 
        ?>

        <div class="card">
          <div class="img-box">
            <span class="badge <?php echo $badgeClass; ?>">
              <?php echo htmlspecialchars($badgeText); ?>
            </span>
            <img src="<?php echo htmlspecialchars($img); ?>" alt="Property">
          </div>
          <div class="content">
            <div class="price">
              <?php echo number_format((float)$row['price']); ?> BDT
            </div>
            <div class="title">
              <?php echo htmlspecialchars($row['title']); ?>
            </div>
            <div class="location">
              <?php echo htmlspecialchars($row['location']); ?>
            </div>
            <div class="divider"></div>

            <div class="stats">
              <div class="stat">
                <div class="num"><?php echo (int)$row['num_bedrooms']; ?></div>
                <div class="lbl">Beds</div>
              </div>
              <div class="stat">
                <div class="num"><?php echo (int)$row['num_bathrooms']; ?></div>
                <div class="lbl">Baths</div>
              </div>
              <div class="stat">
                <div class="num"><?php echo number_format((float)$row['area_sqft']); ?></div>
                <div class="lbl">Sqft</div>
              </div>
            </div>

            <a class="btn" href="viewdetails.php?id=<?php echo (int)$row['property_id']; ?>">View Details</a>
          </div>
        </div>

      <?php endforeach; ?>
    <?php else: ?>
      <p style="padding:20px;">No properties found.</p>
    <?php endif; ?>
  </div>
</section>

</body>
</html>
