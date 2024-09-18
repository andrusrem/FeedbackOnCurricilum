<?php

namespace Api\Controllers;
use PDO;
class GradeController
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    // Function to get all grades
    public function getGrades()
    {
        $stmt = $this->pdo->query("SELECT * FROM grades");
        $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($grades);
    }

    // Function to get grade by ID
    public function getGradeById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM grades WHERE id = ?");
        $stmt->execute([$id]);
        $grade = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($grade) {
            echo json_encode($grade);
        } else {
            echo json_encode(["message" => "Grade not found"]);
        }
    }

    // Function to create a new grade
    public function createGrade()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['grade']) && isset($data['student_id']) && isset($data['class_id'])) {
            $stmt = $this->pdo->prepare("INSERT INTO grades (grade, comment, student_id, class_id) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$data['grade'], $data['comment'], $data['student_id'], $data['class_id']])) {
                echo json_encode(["message" => "Grade created successfully"]);
            } else {
                echo json_encode(["message" => "Failed to create grade"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    // Function to update grade by ID
    public function updateGrade($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['grade']) && isset($data['student_id']) && isset($data['class_id'])) {
            $stmt = $this->pdo->prepare("UPDATE grades SET grade = ?, comment = ?, student_id = ?, class_id = ? WHERE id = ?");
            if ($stmt->execute([$data['grade'], $data['comment'], $data['student_id'], $data['class_id'], $id])) {
                echo json_encode(["message" => "Grade updated successfully"]);
            } else {
                echo json_encode(["message" => "Failed to update grade"]);
            }
        } else {
            echo json_encode(["message" => "Invalid input"]);
        }
    }

    // Function to delete grade by ID
    public function deleteGrade($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM grades WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo json_encode(["message" => "Grade deleted successfully"]);
        } else {
            echo json_encode(["message" => "Failed to delete grade"]);
        }
    }
}



?>