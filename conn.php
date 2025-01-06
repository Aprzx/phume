<?php
        //check if the database file exists and create a new if not
        if(!is_file('db/user_phume.sqlite3')){
                file_put_contents('user_phume.sqlite3', null);
        }
        // connecting the database
        $conn = new PDO('sqlite:db/user_phume.sqlite3');
        //Setting connection attributes
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Query for creating reating the member table in the database if not exist yet.
        $query = "CREATE TABLE IF NOT EXISTS member(mem_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username TEXT, password TEXT, email TEXT, ranks TEXT NOT NULL, status VARCHAR(20) DEFAULT offline)";
        //Executing the query
        $conn->exec($query);
        
?>