<?php
require_once 'conn.php';
require_once 'specific_conn.php';

$log_results = $specific_conn->query('SELECT * FROM log ORDER BY timestamp DESC');
$log_entries = [];

while ($row = $log_results->fetch(PDO::FETCH_ASSOC)) {
    $log_entries[] = $row;
}

header('Content-Type: application/json');
echo json_encode($log_entries);
?>
