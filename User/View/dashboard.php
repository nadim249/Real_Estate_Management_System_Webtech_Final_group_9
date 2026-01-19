<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$email = $_SESSION["email"] ?? "";
$username = $_SESSION["username"] ?? "";
$isLoggedIn = $_SESSION["isLoggedIn"] ?? false;

// DB
$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT property_id, title, location, price, type, image_url
        FROM properties
        WHERE status = 'Active'
        ORDER BY property_id DESC
        LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EstateNexus - Home</title>
  <link rel="stylesheet" href="../Public/css/style6.css" />
  
</head>
<body>

<?php 
if ($isLoggedIn) include 'navloged.php';
else include 'nav.php';
?>

<section class="hero">
  <div class="hero-box">
    <h1>Find Your Dream Home</h1>
    <p>Browse thousands of properties for sale and rent.</p>

    <div class="simple-search">
      <input id="q" type="text" placeholder="Search by location, title, type..." />
      <a class="btn-search" id="searchBtn" href="properties.php">Search</a>
    </div>
  </div>
</section>

<section class="featured">
  <h2>Featured Properties</h2>

  <div class="cards">

    <?php if ($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <?php
          $img = !empty($row['image_url'])
            ? $row['image_url']
            : "https://images.unsplash.com/photo-1564013799919-ab600027ffc6?q=80&w=1200&auto=format&fit=crop";

          $badgeText = "Featured";
          $badgeClass = "sale"; 
        ?>

        <div class="p-card">
          <div class="p-img">
            <span class="badge <?php echo $badgeClass; ?>">
              <?php echo htmlspecialchars($badgeText); ?>
            </span>

            <img src="<?php echo htmlspecialchars($img); ?>" alt="Property">
          </div>

          <div class="p-body">
            <div class="p-price"><?php echo number_format((float)$row['price']); ?> BDT</div>
            <div class="p-title"><?php echo htmlspecialchars($row['title']); ?></div>
            <div class="p-loc"><?php echo htmlspecialchars($row['location']); ?></div>

            <a class="btn-search" style="margin-top:12px; display:inline-block;"
               href="viewdetails.php?id=<?php echo (int)$row['property_id']; ?>">
              View Details
            </a>
          </div>
        </div>

      <?php endwhile; ?>
    <?php else: ?>
      <p style="padding: 20px;">No featured properties found.</p>
    <?php endif; ?>

  </div>
</section>

<script>
  const q = document.getElementById('q');
  const btn = document.getElementById('searchBtn');

  function updateLink(){
    const val = encodeURIComponent(q.value.trim());
    btn.href = val ? `../Controller/propertiesearch.php?q=${val}` : 'properties.php';
  }

  q.addEventListener('input', updateLink);
  updateLink();
</script>

</body>
</html>
