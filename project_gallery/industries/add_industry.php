<?php
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $industry_name = $_POST['industry_name'];

    $sql = "INSERT INTO industries (industry_name) VALUES ('$industry_name')";
    if ($conn->query($sql) === TRUE) {
        header("Location: list_industries.php?success=Industry added!");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<form method="POST">
    <label>Industry Name:</label>
    <input type="text" name="industry_name" required>
    <button type="submit">Add Industry</button>
</form>


