<?php
require_once 'specific_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image_url = $_POST['image_url'];
    $quantity = $_POST['quantity'];

    // Insert new item into the database
    $query = "INSERT INTO user_data (name, image_url, quantity) VALUES (?, ?, ?)";
    $stmt = $specific_conn->prepare($query);
    $stmt->execute([$name, $image_url, $quantity]);

    // Insert a log entry for the addition
    $log_query = "INSERT INTO log (action, item_name) VALUES (?, ?)";
    $log_stmt = $specific_conn->prepare($log_query);
    $log_stmt->execute(['Add Item', $name]);

    // Check the referring page and redirect accordingly
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        if (strpos($referer, 'inside.php') !== false) {
            header("Location: inside.php");
        } else {
            header("Location: add_item.php");
        }
    } else {
        header("Location: add_item.php"); // Default redirection
    }
    exit();
}
?>
