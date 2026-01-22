<?php
include('../MODEL/DatabaseConn.php');  


$db = new DatabaseConn();


$conn = $db->openConnection();


$activeListings = $conn->query(
    "SELECT COUNT(*) AS total FROM properties WHERE status='Active'"
)->fetch_assoc()['total'];







$listings = $conn->query(
    "SELECT title, price, type, status,price FROM properties ORDER BY created_at DESC LIMIT 5"
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
          <h2 style="font-size: 40px;"> Estate-Us</h2>
          <hr>
          <div class="gap">

          </div>
      <a href="Dashboard.php" class="active"><img src="images/dashboard.png" class="sb-icon" alt="Dashboard">Dashboard</a>
      <a href="Properties.php"><img src="images/Myprop.png" class="sb-icon" alt="My Properties">My Properties</a>
      <a href="Inquiries.php"><img src="images/inq.png" class="sb-icon" alt="Inquiries">Inquiries</a>
      <a href="AddProperty.php"><img src="images/addproperties.png" class="sb-icon" alt="Add Property">Add Property</a>
    <a href="../CONTROLLER/logout.php"><img src="images/undo.png" class="sb-icon" alt="Logout">Logout</a>
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

           

   
         
        </div>
         <h2>Recent Listing Performance</h2>

        <table>
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $listings->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['type'] ?></td>
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