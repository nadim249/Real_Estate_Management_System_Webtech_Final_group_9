<?php
include('../MODEL/DatabaseConn.php');  


$db = new DatabaseConn();


$conn = $db->openConnection();


$activeListings = $conn->query(
    "SELECT COUNT(*) AS total FROM listings WHERE status='Active'"
)->fetch_assoc()['total'];

$totalViews = $conn->query(
    "SELECT SUM(views) AS total FROM listings"
)->fetch_assoc()['total'];

$totalInquiries = $conn->query(
    "SELECT SUM(inquiries) AS total FROM listings"
)->fetch_assoc()['total'];

$listings = $conn->query(
    "SELECT * FROM listings ORDER BY created_at DESC LIMIT 5"
);
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
          <h2> Estate-Us</h2>
          <hr>
          <div class="gap">

          </div>
      <a href="#">Dashboard</a>
      <a href="#">My Properties</a>
      <a href="#">Inquiries</a>
      <a href="#">Add Property</a>
    </div>  


    <div class="main-content">
        <h1>Welcome to the Agent Dashboard</h1>
        <p>Here you can manage your properties and view inquiries.</p>

    <div class="container">
        <div class="cards">
            <div class="card">
                <h3> Active Listings</h3>
                <p><?= $activeListings ?></p>
            </div>

            <div class="card">
                <h3> Inquiries Received</h3>
                <p><?= $totalInquiries ?></p>
            </div>

            <div class="card">
                <h3> Total Views</h3>
                <p><?= $totalViews ?></p>
            </div>
        </div>
         <h2>Recent Listing Performance</h2>

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
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
    </div>
 </div>

    


        

</body>
</html>