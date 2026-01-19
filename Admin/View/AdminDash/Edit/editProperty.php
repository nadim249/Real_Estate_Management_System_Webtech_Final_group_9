<?php
session_start();
require_once "../../../Model/DatabaseConnection.php";

if (!isset($_GET['id'])) {
    header("Location: ../propertiesdata.php");
    exit;
}

$propertyId = intval($_GET['id']);

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM properties WHERE property_id = $propertyId";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    header("Location: ../propertiesdata.php");
    exit;
}

$property = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Property</title>
    <link rel="stylesheet" href="../../../Public/CSS/update.css">
</head>

<body>

    <div class="update-container">

        <div class="update-header">
            <h2>Edit Property</h2>
        </div>

        <form method="POST" action="../../../Controller/updates/updateProperty.php" class="update-form">

            <input type="hidden" name="property_id"
                value="<?php echo $property['property_id']; ?>">

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                    value="<?php echo htmlspecialchars($property['title']); ?>" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" required><?php echo htmlspecialchars($property['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="type" required>
                    <option value="House" <?= $property['type'] == 'House' ? 'selected' : '' ?>>House</option>
                    <option value="Apartment" <?= $property['type'] == 'Apartment' ? 'selected' : '' ?>>Apartment</option>
                    <option value="Land" <?= $property['type'] == 'Land' ? 'selected' : '' ?>>Land</option>
                    <option value="Commercial" <?= $property['type'] == 'Commercial' ? 'selected' : '' ?>>Commercial</option>

                </select>
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location"
                    value="<?php echo htmlspecialchars($property['location']); ?>" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price"
                    value="<?php echo $property['price']; ?>" required>
            </div>

            <div class="form-group">
                <label>Area (sqft)</label>
                <input type="number" name="area_sqft"
                    value="<?php echo $property['area_sqft']; ?>" required>
            </div>

            <div class="form-group">
                <label>Number of Bedrooms</label>
                <input type="number" name="num_bedrooms"
                    value="<?php echo $property['num_bedrooms']; ?>" required>
            </div>

            <div class="form-group">
                <label>Number of Bathrooms</label>
                <input type="number" name="num_bathrooms"
                    value="<?php echo $property['num_bathrooms']; ?>" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Pending" <?= $property['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= $property['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Rejected" <?= $property['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </div>

            <div class="form-group">
                <label>Is Sold</label>
                <input type="checkbox" name="is_sold" value="1"
                    <?php echo isset($property['is_sold']) && $property['is_sold'] ? 'checked' : ''; ?>>
            </div>

            <div class="update-actions">

                <button type="submit" class="btn-save">Update Property</button>
                <a href="../propertiesdata.php" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
</body>

</html>