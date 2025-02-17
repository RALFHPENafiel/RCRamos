<?php
include "../config/database.php";

$sql = "SELECT * FROM industries";
$result = $conn->query($sql);

echo "<h2>Industries</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['industry_name']} <a href='edit_industry.php?id={$row['industry_id']}'>Edit</a> | 
    <a href='delete_industry.php?id={$row['industry_id']}'>Delete</a></p>";
}
?>
<a href="add_industry.php">Add New Industry</a>
