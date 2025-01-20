<?php
require_once 'specific_conn.php'; // Include the specific connection script

try {
    // Clear log entries
    $sql = "DELETE FROM log";
    if ($specific_conn->exec($sql)) {
        echo "Logs cleared successfully";
    } else {
        $error = $specific_conn->errorInfo();
        echo "Error clearing logs: " . $error[2];
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
