<?php
require_once 'conn.php';
require_once 'specific_conn.php';

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);
$ids = $data['ids'];

if (!empty($ids)) {
    // Prepare the placeholders for the query
    $placeholders = rtrim(str_repeat('?,', count($ids)), ',');

    // Prepare and execute the delete statement
    try {
        // Fetch the item names before deletion for logging
        $stmtSelect = $specific_conn->prepare("SELECT id, name FROM user_data WHERE id IN ($placeholders)");
        $stmtSelect->execute($ids);
        $items = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

        // Delete the items
        $stmtDelete = $specific_conn->prepare("DELETE FROM user_data WHERE id IN ($placeholders)");
        $stmtDelete->execute($ids);
        
        // Log each deletion
        foreach ($items as $item) {
            $stmtLog = $specific_conn->prepare("INSERT INTO log (action, item_name) VALUES (?, ?)");
            $stmtLog->execute(['Delete Item', $item['name']]);
        }

        // Check if rows were deleted
        if ($stmtDelete->rowCount() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No rows deleted']);
        }
    } catch (Exception $e) {
        // Log the error and return an error response
        error_log("Error deleting users: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Error deleting users']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No IDs provided']);
}
?>
