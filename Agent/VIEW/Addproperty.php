

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
      <a href="Properties.php"><img src="images/Myprop.png" class="sb-icon" alt="My Properties">My Properties</a>
      <a href="Inquiries.php"><img src="images/inq.png" class="sb-icon" alt="Inquiries">Inquiries</a>
      <a href="AddProperty.php" class="active"><img src="images/addproperties.png" class="sb-icon" alt="Add Property">Add Property</a>
        </div>
<div class="main-content">
    <h1>Add Property</h1>
    <p>Add a new listing. </p>

    <div class="container">
      <form action="../CONTROLLER/addListing.php" method="POST" class="add-form">

        <label>Property Name</label>
        <input type="text" name="property_name" required>

        <label>Status</label>
        <select name="status" required>
          <option value="Active">Active</option>
          <option value="Sold">Sold</option>
        </select>

        <button type="submit" name="add_property">Add Property</button>
      </form>
    </div>
  </div>

        
    </div>


</body>
</html>
