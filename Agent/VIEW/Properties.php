<?php
include('../MODEL/DatabaseConn.php');

$db = new DatabaseConn();
$conn = $db->openConnection();


$listings = $conn->query("SELECT id, property_name, views, inquiries, status FROM listings ORDER BY created_at DESC");

if(!$listings){
    die("Query failed: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link rel="stylesheet" href="../Public/CSS/styleDash.css">
</head>

<body>

    <div class="layout">
        <div class="sidebar">
             <h2 style="font-size: 40px;"> Estate-Us</h2>
            <hr>

            <div class="gap"></div>
  <a href="Dashboard.php"><img src="images/dashboard.png" class="sb-icon" alt="Dashboard">Dashboard</a>
      <a href="Properties.php" class="active"><img src="images/Myprop.png" class="sb-icon" alt="My Properties">My Properties</a>
      <a href="Inquiries.php"><img src="images/inq.png" class="sb-icon" alt="Inquiries">Inquiries</a>
      <a href="AddProperty.php"><img src="images/addproperties.png" class="sb-icon" alt="Add Property">Add Property</a>
        </div>

          <div class="main-content">
  <h1>My Properties</h1>
  <p>All your listings are shown below.</p>

  <div class="container">
    <table>
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Views</th>
                    <th>Inquiries</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $listings->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['property_name'] ?></td>
                    <td><?= $row['views'] ?></td>
                    <td><?= $row['inquiries'] ?></td>
                    <td><?= $row['status'] ?></td>

                     <td>
        <form action="deleteListing.php" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this property?');">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" class="btn-delete">Delete</button>
        </form>
      </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

  </div>
</div>
    </div>

</body>
</html>
