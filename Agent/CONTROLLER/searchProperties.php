<?php
include('../MODEL/DatabaseConn.php');

$db = new DatabaseConn();
$conn = $db->openConnection();

$q = trim($_POST['q'] ?? '');
$status = trim($_POST['status'] ?? '');
$type = trim($_POST['type'] ?? '');

$sql = "SELECT property_id, title, type, location, price, area_sqft, num_bedrooms, num_bathrooms, status
        FROM properties
        WHERE 1";

$params = [];
$typesStr = "";

// title search
if ($q !== "") {
    $sql .= " AND title LIKE ?";
    $params[] = "%".$q."%";
    $typesStr .= "s";
}

// status filter
if ($status !== "") {
    $sql .= " AND status = ?";
    $params[] = $status;
    $typesStr .= "s";
}

// type filter
if ($type !== "") {
    $sql .= " AND type = ?";
    $params[] = $type;
    $typesStr .= "s";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($typesStr, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<tr><td colspan='9' style='text-align:center;'>No results found</td></tr>";
    exit;
}

while ($row = $result->fetch_assoc()):
?>
<tr>
  <td><?= htmlspecialchars($row['title']) ?></td>
  <td><?= htmlspecialchars($row['type']) ?></td>
  <td><?= htmlspecialchars($row['location']) ?></td>
  <td><?= htmlspecialchars($row['price']) ?></td>
  <td><?= htmlspecialchars($row['area_sqft']) ?></td>
  <td><?= htmlspecialchars($row['num_bedrooms']) ?></td>
  <td><?= htmlspecialchars($row['num_bathrooms']) ?></td>
  <td><?= htmlspecialchars($row['status']) ?></td>

  <td>
    <form action="../CONTROLLER/deleteListing.php" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this property?');">
      <input type="hidden" name="id" value="<?= $row['property_id'] ?>">
      <button type="submit" class="btn-delete">
        <img src="images/trash-bin.png" class="btn-icon" alt="">
      </button>
    </form>
  </td>
</tr>
<?php endwhile; ?>
