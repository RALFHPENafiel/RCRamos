<?php
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['project_name'];
    $description = $_POST['description'];
    $details = $_POST['project_details'];
    $location = $_POST['location'];
    $size = $_POST['size'];
    $budget = $_POST['project_budget'];
    $duration = $_POST['project_duration'];

    // Check if foreign keys are provided, else set NULL
    $client_id = !empty($_POST['client_id']) ? $_POST['client_id'] : NULL;
    $industry_id = !empty($_POST['industry_id']) ? $_POST['industry_id'] : NULL;
    $sector_id = !empty($_POST['sector_id']) ? $_POST['sector_id'] : NULL;
    $architect_id = !empty($_POST['architect_id']) ? $_POST['architect_id'] : NULL;

    // Insert project data first
    $sql = "INSERT INTO projects (project_name, description, project_details, location, size, project_budget, project_duration, client_id, industry_id, sector_id, architect_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdsiiiii", $name, $description, $details, $location, $size, $budget, $duration, $client_id, $industry_id, $sector_id, $architect_id);

    if ($stmt->execute()) {
        $project_id = $stmt->insert_id; // Get last inserted project ID

        // Handle Image Uploads
        if (!empty($_FILES['project_images']['name'][0])) {
            $uploadDir = "../uploads/";
            foreach ($_FILES['project_images']['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($_FILES['project_images']['name'][$key]);
                $targetFilePath = $uploadDir . time() . "_" . $fileName; // Rename to prevent duplicates
                
                // Validate file type
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($fileType), $allowedTypes)) {
                    if (move_uploaded_file($tmp_name, $targetFilePath)) {
                        // Store image path in database
                        $imageSQL = "INSERT INTO project_images (project_id, image_url) VALUES (?, ?)";
                        $imageStmt = $conn->prepare($imageSQL);
                        $imageStmt->bind_param("is", $project_id, $targetFilePath);
                        $imageStmt->execute();
                    }
                }
            }
        }

        header("Location: list_projects.php?success=Project added with images!");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// DO NOT CLOSE CONNECTION HERE: $conn->close();
?>

<form method="POST" enctype="multipart/form-data">
    <label>Project Name:</label><input type="text" name="project_name" required><br>
    <label>Description:</label><textarea name="description"></textarea><br>
    <label>Details:</label><textarea name="project_details"></textarea><br>
    <label>Location:</label><input type="text" name="location"><br>
    <label>Size:</label><input type="text" name="size"><br>
    <label>Budget:</label><input type="number" name="project_budget"><br>
    <label>Duration:</label><input type="text" name="project_duration"><br>
    
    <!-- Select fields for Foreign Keys -->
    <label>Client:</label>
    <select name="client_id">
        <option value="">Select Client</option>
        <?php
        $result = $conn->query("SELECT client_id, client_name FROM clients");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['client_id']}'>{$row['client_name']}</option>";
        }
        ?>
    </select><br>

    <label>Industry:</label>
    <select name="industry_id">
        <option value="">Select Industry</option>
        <?php
        $result = $conn->query("SELECT industry_id, industry_name FROM industries");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['industry_id']}'>{$row['industry_name']}</option>";
        }
        ?>
    </select><br>

    <label>Sector:</label>
    <select name="sector_id">
        <option value="">Select Sector</option>
        <?php
        $result = $conn->query("SELECT sector_id, sector_name FROM sectors");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['sector_id']}'>{$row['sector_name']}</option>";
        }
        ?>
    </select><br>

    <label>Architect:</label>
    <select name="architect_id">
        <option value="">Select Architect</option>
        <?php
        $result = $conn->query("SELECT architect_id, architect_name FROM architects");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['architect_id']}'>{$row['architect_name']}</option>";
        }
        ?>
    </select><br>

    <!-- Image Upload -->
    <label>Upload Images:</label>
    <input type="file" name="project_images[]" multiple accept="image/*"><br>

    <button type="submit">Add Project</button>
</form>

<?php
// Close connection at the end (after all queries)
$conn->close();
?>
