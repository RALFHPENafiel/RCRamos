<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM clients WHERE client_id=$id");
    $client = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $_POST['client_name'];
    $conn->query("UPDATE clients SET client_name='$client_name' WHERE client_id=$id");
    header("Location: list_clients.php?success=Client updated!");
}
?>

<form method="POST">
    <input type="text" name="client_name" value="<?= $client['client_name'] ?>" required>
    <button type="submit">Update Client</button>
</form>
