<?php
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $completion_percentage = $_POST['completion_percentage'];

    $sql = "UPDATE project_progress SET completion_percentage='$completion_percentage' WHERE project_id='$project_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../projects/list_projects.php?success=Progress Updated!");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<form method="POST">
    <label>Select Project:</label>
    <select name="project_id">
        <?php
        $result = $conn->query("SELECT * FROM projects");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['project_id']}'>{$row['project_name']}</option>";
        }
        ?>
    </select>
    <label>Completion Percentage:</label>
    <input type="number" name="completion_percentage" min="0" max="100" required>
    <button type="submit">Update Progress</button>
</form>
