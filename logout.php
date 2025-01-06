<?php
session_start();
require_once 'conn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['mem_id'])) {
    echo "Session User ID: " . $_SESSION['mem_id'] . "<br>";

    // Update user status to offline
    $update_status = "UPDATE `member` SET `status` = 'offline' WHERE `mem_id` = :mem_id";
    $stmt = $conn->prepare($update_status);
    $stmt->bindParam(':mem_id', $_SESSION['mem_id']);

    if ($stmt->execute()) {
        echo "อัพเดทสถานะเรียบร้อยแล้ว.";
    } else {
        echo "ข้อผิดพลาดในการอัพเดทสถานะ: ";
        print_r($stmt->errorInfo());
    }

    // Clear all session variables
    session_unset();
    session_destroy();
} else {
    echo "ไม่ได้ตั้งค่ารหัสผู้ใช้ใน session.";
}

// Redirect to home page
header('Location: home_phume.php');
exit();
?>
