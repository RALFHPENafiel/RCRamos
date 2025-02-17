<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM clients WHERE client_id=$id");
    header("Location: list_clients.php?success=Client deleted!");
}
?>
