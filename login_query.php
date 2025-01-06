<?php
// Starting the session securely
session_start();
// Including the database connection
require_once 'conn.php';

if (isset($_POST['login'])) {
    try {
        // Sanitize and validate input
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        if (!$username || !$password) {
            throw new Exception("กรุณากรอกข้อมูลให้ครบถ้วน");
        }

        // Select Query to fetch the user data including rank
        $query = "SELECT mem_id, password, username, ranks FROM member WHERE username = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $password === $row['password']) {
            // Generate a new session ID to prevent session fixation
            session_regenerate_id(true);
            
            // Update the user's status to online
            updateUserStatus($conn, $row['mem_id'], 'online');

            // Set session variables
            $_SESSION['mem_id'] = $row['mem_id'];
            $_SESSION['last_activity'] = time();
            $_SESSION['username'] = $row['username'];
            $_SESSION['ranks'] = $row['ranks'];

            // Check if the user is admin based on rank
            if ($row['ranks'] === 'admin') {
                header('location: dashboard.php');
                exit();
            } else {
                header('location: inside.php');
                exit();
            }
        } else {
            throw new Exception("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('location: login_phum.php');
        exit();
    }
}

function updateUserStatus($conn, $memId, $status) {
    $updateQuery = "UPDATE member SET status = :status WHERE mem_id = :mem_id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':status', $status);
    $updateStmt->bindParam(':mem_id', $memId);
    $updateStmt->execute();
}
?>