<?php
namespace Api\Controllers;

use PDO;
$db_file = 'db.sqlite';
$pdo = new PDO("sqlite:$db_file");


class StudentController
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Function to get all students
    function getStudents($pdo)
    {
        $stmt = $pdo->query("SELECT * FROM students");
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($students);
    }

    // Function to get student by ID
    function getStudentByNameAndGroup($pdo, $name, $group)
    {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE student_name = ? AND group_name = ? COLLATE NOCASE"); # COLLATE NOCASE means search with case insensitive
        $stmt->execute([$name, $group]);
        return $stmt->fetch(PDO::FETCH_OBJ); 
    }

    // Function to create a new grade
    function createStudent($pdo)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['group_name']) && isset($data['student_name'])) {
            $stmt = $pdo->prepare("INSERT INTO students (group_name, student_name) VALUES (?, ?)");
            if ($stmt->execute([$data['group_name'], $data['student_name']])) {
                echo json_encode(["message" => "Student created successfully"]);
            } else {
                echo json_encode(["message" => "Failed to create student"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    // Function to update grade by ID
    function updateStudent($pdo, $id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['group_name']) && isset($data['student_name'])) {
            $stmt = $pdo->prepare("UPDATE students SET group_name = ?, student_name = ? WHERE id = ?");
            if ($stmt->execute([$data['group_name'], $data['student_name'], $id])) {
                echo json_encode(["message" => "Student updated successfully"]);
            } else {
                echo json_encode(["message" => "Failed to update student"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    // Function to delete grade by ID
    function deleteStudent($pdo, $id)
    {
        $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo json_encode(["message" => "Student deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete student"]);
        }
    }
}


