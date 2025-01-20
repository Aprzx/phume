<?php
require_once 'specific_conn.php';

try {
    $stmt = $specific_conn->query("SELECT COUNT(*) AS count FROM user_data WHERE quantity < 1");
    $result = $stmt->fetch();

    $threshold = 2;
    $alert = false;
    $message = '';

    if ($result['count'] < $threshold / 2) {
        $alert = true;
        $message = 'Alert: Data is less than half of the threshold.';
    }

    // Redirect back to the form page with the alert message
    header('Location: test.php?alert=' . ($alert ? 'true' : 'false') . '&message=' . urlencode($message));
    exit();
} catch (PDOException $e) {
    // Redirect with an error message
    header('Location: test.php?alert=true&message=' . urlencode('Database error: ' . $e->getMessage()));
    exit();
}
?>
