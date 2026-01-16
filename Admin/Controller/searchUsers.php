<?php
include "../Model/DatabaseConnection.php";

// Sanitize input (also using prepared statements below)
$search = $_POST['query'] ?? '';

$db = new DatabaseConnection();
$conn = $db->openConnection();
// Use prepared statements to avoid SQL injection
$sql = "SELECT user_id, full_name, email, phone, created_at
        FROM buyers
        WHERE full_name LIKE ? OR email LIKE ? OR phone LIKE ?";

$stmt = $conn->prepare($sql);
$like = "%" . $search . "%";
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['user_id']);
        $name = htmlspecialchars($row['full_name']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $created = htmlspecialchars($row['created_at']);

        echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$created</td>
                <td>
                    <a href='Edit/editUser.php?id=$id' class='edit-btn'>Edit</a>
                    <a href='../../Controller/Deletes/deleteUser.php?id=$id' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No users found</td></tr>";
}
