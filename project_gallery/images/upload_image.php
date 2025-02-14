<?php
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $project_id = $_POST["project_id"];
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $target_file)) {
        $sql = "INSERT INTO project_images (project_id, image_url) VALUES ('$project_id', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header("Location: list_projects.php?success=Image uploaded!");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
<form method="POST" enctype="multipart/form-data">
    <label>Select Project:</label>
    <select name="project_id">
        <?php
        $result = $conn->query("SELECT * FROM projects");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['project_id']}'>{$row['project_name']}</option>";
        }
        ?>
    </select>
    <input type="file" name="image" required>
    <button type="submit">Upload Image</button>
</form>
