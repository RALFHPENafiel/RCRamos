<?php
include "config/database.php";
include "includes/header.php";

$limit = 6; // Number of projects per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total records
$total_sql = "SELECT COUNT(*) FROM projects";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $limit);

$sql = "SELECT p.*, pr.completion_percentage 
        FROM projects p
        LEFT JOIN project_progress pr ON p.project_id = pr.project_id
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

echo '<h2 class="mb-4">Project Dashboard</h2>';
echo '<div class="row">';
while ($row = $result->fetch_assoc()) {
    echo '<div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">' . $row['project_name'] . '</h5>
                    <p class="card-text">' . substr($row['description'], 0, 100) . '...</p>
                    <p><strong>Location:</strong> ' . $row['location'] . '</p>
                    <p><strong>Completion:</strong> ' . $row['completion_percentage'] . '%</p>
                    <a href="projects/view_project.php?id=' . $row['project_id'] . '" class="btn btn-primary">View</a>
                </div>
            </div>
          </div>';
}
echo '</div>';

// Pagination links
echo '<nav><ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
}
echo '</ul></nav>';

include "includes/footer.php";
?>
<form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <select name="industry_id" class="form-select">
                <option value="">Select Industry</option>
                <?php
                $industries = $conn->query("SELECT * FROM industries");
                while ($row = $industries->fetch_assoc()) {
                    echo '<option value="' . $row['industry_id'] . '">' . $row['industry_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="sector_id" class="form-select">
                <option value="">Select Sector</option>
                <?php
                $sectors = $conn->query("SELECT * FROM sectors");
                while ($row = $sectors->fetch_assoc()) {
                    echo '<option value="' . $row['sector_id'] . '">' . $row['sector_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="client_id" class="form-select">
                <option value="">Select Client</option>
                <?php
                $clients = $conn->query("SELECT * FROM clients");
                while ($row = $clients->fetch_assoc()) {
                    echo '<option value="' . $row['client_id'] . '">' . $row['client_name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>
