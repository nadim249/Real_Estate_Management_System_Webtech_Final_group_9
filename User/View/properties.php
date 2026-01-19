<?php
require_once "../Model/DatabaseConnection.php";

session_start();


$email = $_SESSION["email"] ??"";
$username = $_SESSION["username"] ??"";
$isLoggedIn= $_SESSION["isLoggedIn"]??"";

// DB
$db = new DatabaseConnection();
$conn = $db->openConnection();

// Example query (change columns/table names if different)
$sql = "SELECT property_id, title, location, price, type, num_bedrooms, num_bathrooms, area_sqft, image_url
        FROM properties
        WHERE status = 'Active'
        ORDER BY property_id DESC";

$result = $conn->query($sql);

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
<?php if ($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>

 

        <div class="card">
          <div class="img-box">
            <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Property" />
            <span class="tag tag-blue"><?php echo strtoupper(htmlspecialchars($row['type'])); ?></span>
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

            <button class="btn">
              <a href="viewdetails.php?id=<?php echo (int)$row['property_id']; ?>">View Details</a>
            </button>
          </div>
        </div>

      <?php endwhile; ?>
    <?php else: ?>
      <p style="padding:20px;">No properties found.</p>
    <?php endif; ?>




    </div>
  </section>
 
</body>
</html>
