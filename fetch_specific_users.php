<?php
require_once 'specific_conn.php';

// Fetch user data
$results = $specific_conn->query('SELECT * FROM user_data');

$users = [];
while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
    $users[] = $row;
}

// Close the database connection
$specific_conn = null;

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>
