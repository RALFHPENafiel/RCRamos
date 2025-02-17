<?php
include "../config/database.php";

$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

echo "<h2>Clients</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['client_name']} <a href='edit_client.php?id={$row['client_id']}'>Edit</a> | 
    <a href='delete_client.php?id={$row['client_id']}'>Delete</a></p>";
}
?>
<a href="add_client.php">Add New Client</a>
