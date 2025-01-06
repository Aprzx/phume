<?php
// Starting the session
session_start();

// Including the database connection
require_once 'conn.php';

if (isset($_POST['register'])) {
        // Setting variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $rank = 'member'; // Default rank set to 'member'

        // Insertion Query
        $query = "INSERT INTO `member` (username, password, email, ranks) VALUES(:username, :password, :email, :rank)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':rank', $rank);

        // Check if the execution of the query is successful
        if ($stmt->execute()) {
                // Setting a 'success' session to save our insertion success message
                $_SESSION['success'] = "Successfully created an account";

                // Redirecting to the login page
                header('location: login_phum.php');
        } else {
                // Error handling
                $_SESSION['error'] = "Error creating account";
                header('location: register_phum.php');
        }
}
