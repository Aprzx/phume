<?php
require_once 'specific_conn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
</head>
<body>
    <h1>Add New Item</h1>
    <form action="process_add_item.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="image_url">Image URL:</label><br>
        <input type="text" id="image_url" name="image_url" required><br>
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required><br><br>
        <input type="submit" value="Add Item">
    </form>
    <a href="dashboard.php">User management</a>
</body>
</html>
