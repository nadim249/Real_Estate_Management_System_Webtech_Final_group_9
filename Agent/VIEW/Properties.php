<?php
include('../MODEL/DatabaseConn.php');

$db = new DatabaseConn();
$conn = $db->openConnection();


$listings = $conn->query("SELECT property_id, title, type, location, price, area_sqft, num_bedrooms, num_bathrooms, status FROM properties ORDER BY created_at DESC");


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
 <div class="page-header">
  <div>
    <h1>My Properties</h1>
    <p>All your listings are shown below.</p>
  </div>

  <div class="search-box">
    <input type="text" id="q" placeholder="Search title..." onkeyup="searchProperties()">

    <select id="status" onchange="searchProperties()">
      <option value="">All Status</option>
      <option value="Active">Active</option>
      <option value="Pending">Pending</option>
      <option value="Rejected">Rejected</option>
    </select>

    <select id="type" onchange="searchProperties()">
      <option value="">All Type</option>
      <option value="Apartment">Apartment</option>
      <option value="House">House</option>
      <option value="Commercial">Commercial</option>
      <option value="Land">Land</option>
    </select>

    <button type="button" onclick="clearSearch()">Clear</button>
  </div>
</div>

<div id="ajaxResponse"></div>


  <div class="container">
    <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Area(sqft)</th>
                    <th>Bedrooms</th>
                    <th>Bathrooms</th>
                    <th>Status</th>
                    <th>Delete</th> 
                </tr>
            </thead>
                <tbody id="propertiesBody">
                <?php while ($row = $listings->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['location'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['area_sqft'] ?></td>
                    <td><?= $row['num_bedrooms'] ?></td>
                    <td><?= $row['num_bathrooms'] ?></td>
                    <td><?= $row['status'] ?></td>


                     <td>
        <form action="../CONTROLLER/deleteListing.php" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this property?');">
<input type="hidden" name="id" value="<?= $row['property_id'] ?>">
          <button type="submit" class="btn-delete"><img src="images/trash-bin.png" class="btn-icon" alt=""></button>
        </form>
      </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

  </div>
</div>
    </div>
<script>
function searchProperties(){
    var q = document.getElementById("q").value;
    var status = document.getElementById("status").value;
    var type = document.getElementById("type").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                document.getElementById("propertiesBody").innerHTML = this.responseText;
                document.getElementById("ajaxResponse").innerHTML = "";
            } else {
                document.getElementById("ajaxResponse").innerHTML = "Error: " + this.status;
            }
        }
    };

    xhttp.open("POST", "../CONTROLLER/searchProperties.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
      "q=" + encodeURIComponent(q) +
      "&status=" + encodeURIComponent(status) +
      "&type=" + encodeURIComponent(type)
    );
}

function clearSearch(){
    document.getElementById("q").value = "";
    document.getElementById("status").value = "";
    document.getElementById("type").value = "";
    searchProperties();
}
</script>

</body>
</html>
