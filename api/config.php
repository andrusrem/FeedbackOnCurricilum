<?php
$db_file = 'db.sqlite';

try {
    // Create (connect to) SQLite database in the file
    $pdo = new PDO("sqlite:$db_file");
    
    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS grades (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        grade INTEGER NOT NULL,
        comment TEXT,
        student_id INTEGER NOT NULL,
        class_id INTEGER NOT NULL
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        group_name TEXT NOT NULL,
        student_name TEXT NOT NULL
    )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS classes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        class_name TEXT NOT NULL
    )");
    $stmt_students = $pdo->query("SELECT COUNT(*) FROM students");
    $stmt_classes = $pdo->query("SELECT COUNT(*) FROM classes");
    $count_students = $stmt_students->fetchColumn();
    $count_classes = $stmt_classes->fetchColumn();
    if ($count_students == 0) {
        // Insert some initial grades
        $pdo->exec("INSERT INTO students (group_name, student_name) VALUES 
            ('TA-22V', 'Andrus Remets'),
            ('TA-22V', 'Daniel Capineanu'),
            ('TA-22V', 'Aleks-Andres Revkuts'),
            ('TA-22V', 'Maksim Teterin'),
            ('TA-22V', 'Aleksei Silber')
        ");
        echo "Initial students added!";
    }
    if ($count_classes == 0) {
        // Insert some initial grades
        $pdo->exec("INSERT INTO classes (class_name) VALUES 
            ('English'),
            ('Math'),
            ('Programming')"
        );
        echo "Initial classes added!";
    }
    echo "Connected successfully";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>