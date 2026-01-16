<?php
session_start();

$isLoggedIn= $_SESSION["isLoggedIn"] ?? false;
if(!$isLoggedIn){
    Header("Location: login.php");
}
$email = $_SESSION["email"] ??"";
$username = $_SESSION["username"] ??"";

include "../../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$connection = $db->openConnection();

$propertiesQuery = "SELECT * FROM properties ORDER BY created_at DESC";
$propertiesResult = $connection->query($propertiesQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Properties | EstateMgr</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
        <link rel="stylesheet" href="../../Public/CSS/propertise.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body id="page-properties">
        <?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
   <?php include '../includes/sidebar.php'; ?>


    <main class="main-content">
        <header><div class="header-title"><h1>All Properties</h1></div>
                        <div class="user-wrapper">
                    <i class="fa-duotone fa-solid fa-user user-img"></i>
    <div>
        <h4><?php echo htmlspecialchars($username); ?>
        <a href="editProfile.php" class="edit-profile-btn">
        <i class="fa-solid fa-pen"></i>
        </a>
        </h4>
        <small><?php echo htmlspecialchars($email); ?></small>
    </div>
                </div>
    </header>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <p style="color: green;">Property deleted successfully!</p>
<?php endif; ?>

<?php if(isset($_GET['msg']) && $_GET['msg']=='updated'): ?>
    <p class="success-msg">Property updated successfully!</p>
<?php endif; ?>


        <div class="table-responsive">
           <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Property</td>
                        <td>description</td>
                        <td>Type</td>
                        <td>Location</td>
                        <td>Price</td>
                        <td>Area(sq)</td>
                        <td>Num of Bed Rooms</td>
                        <td>Num of Bathroom Rooms</td>
                        <td>Status</td>
                        <td>Is Sold</td>
                        <td>Actions</td>
                    </tr>
                </thead>
            <tbody id="properties-list">
            <?php
            if($propertiesResult->num_rows > 0){
                while($row = $propertiesResult->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['property_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo number_format($row['area_sqft'], 2); ?></td>
                        <td><?php echo $row['num_bedrooms']; ?></td>
                        <td><?php echo $row['num_bathrooms']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['is_sold'] ? 'Sold' : 'Unsold'; ?></td>

                        <td>
                           <a href="Edit/editProperty.php?id=<?php echo $row['property_id']; ?>" class="edit-btn">Edit</a>

                            <a class="delete-btn" href="../../Controller/Deletes/deleteProperty.php?id=<?php echo $row['property_id']; ?>" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }else{
                echo '<tr><td colspan="7">No properties found.</td></tr>';
            }
            ?>
            </tbody>

            </table>
        </div>
    </main>

</body>
</html>