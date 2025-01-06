<?php
// Start the session
session_start();

// Check if the specific database file exists and create a new one if not
if(!is_file('db/specific_user_phume.sqlite3')){
    file_put_contents('db/specific_user_phume.sqlite3', null);
}
// Connect to the SQLite database
try {
    $specific_conn = new PDO('sqlite:db/specific_user_phume.sqlite3');
    // Set connection attributes
    $specific_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Query for creating the user_data table in the database if it doesn't exist yet
    $query = "CREATE TABLE IF NOT EXISTS user_data ( id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, image_url TEXT, quantity INTEGER, timestamp DATETIME DEFAULT CURRENT_TIMESTAMP )";
    // Execute the query
    $specific_conn->exec($query);
} catch (PDOException $e) {
    echo "Specific database connection failed: " . $e->getMessage();
}
?>
