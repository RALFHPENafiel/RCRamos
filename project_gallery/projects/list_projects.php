<?php
include "../config/database.php";

$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

echo "<h2>Projects</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['project_name']} - {$row['location']}
    <a href='edit_project.php?id={$row['project_id']}'>Edit</a> | 
    <a href='delete_project.php?id={$row['project_id']}'>Delete</a></p>";
}
?>
<a href="add_project.php">Add New Project</a>
