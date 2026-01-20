<?php
include "../Model/DatabaseConnection.php";

$search = $_POST['query'] ?? '';

$db = new DatabaseConnection();
$conn = $db->openConnection();
$sql = "SELECT agent_id, full_name, email, phone, commission_rate, total_sales, rating
        FROM agents
        WHERE full_name LIKE ? OR email LIKE ? OR phone LIKE ?";

$stmt = $conn->prepare($sql);
$like = "%" . $search . "%";
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['agent_id']);
        $name = htmlspecialchars($row['full_name']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $commission_rate = htmlspecialchars($row['commission_rate']);
        $total_sales = htmlspecialchars($row['total_sales']);
        $rating = htmlspecialchars($row['rating']);



        echo "<tr>
                <td>$id</td>
                <td>$name</td>
                <td>$email</td>
                <td>$phone</td>
                <td>$commission_rate</td>
                <td>$total_sales</td>
                <td>$rating</td>
                <td>
                    <a href='Edit/editAgent.php?id=$id' class='edit-btn'>Edit</a>
                    <a href='../../Controller/Deletes/deleteAgent.php?id=$id' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this Agent?');\">Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No Agents found</td></tr>";
}
