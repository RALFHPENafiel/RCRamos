<?php
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $_POST['client_name'];

    $sql = "INSERT INTO clients (client_name) VALUES ('$client_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: list_clients.php?success=Client added!");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<form method="POST">
    <label>Client Name:</label>
    <input type="text" name="client_name" required>
    <button type="submit">Add Client</button>
</form>
