<?php
require_once 'conn.php';

// Fetch users
$results = $conn->query('SELECT * FROM member');

$users = [];
while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
    $users[] = $row;
}

// Close the database connection
$conn = null;

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>
