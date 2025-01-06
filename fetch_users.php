<?php
// Connecting to the SQLite database
$conn = new PDO('sqlite:db/user_phume.sqlite3');
// Setting connection attributes
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
