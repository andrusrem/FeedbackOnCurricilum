<?php

namespace Api\Controllers;
use PDO;
include_once __DIR__ . "/StudentController.php";


class GradeController
{
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;

    }

    // Function to get all grades
    public function getGrades()
    {
        $stmt = $this->pdo->query("SELECT * FROM grades");
        $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($grades);
    }
    public function allGrades()
    {

        $stmt = $this->pdo->query("SELECT * FROM grades");


        $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $avg = [
            "English" => 0,
            "Programming" => 0,
            "Math" => 0,
        ];
        $count = [
            "English" => 0,
            "Programming" => 0,
            "Math" => 0,
        ];

        foreach ($grades as $grade) {
             // Check the structure of each grade
            if (isset($grade['class_name']) && isset($grade['grade'])) {
                if (isset($avg[$grade['class_name']])) {
                    $avg[$grade['class_name']] += $grade['grade'];
                    $count[$grade['class_name']]++;
                }
            } else {
                echo "Invalid grade structure: ";
                 // Show the problematic structure
            }
        }

        foreach ($avg as $class => $totalGrade) {
            if ($count[$class] > 0) {
                $avg[$class] = $totalGrade / $count[$class];
            }
        }
        echo "
        <html>
<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='./style.css'>
</head>
<body>
        <div class='container'>
        <table class='table'>
        <tr>
        <th>Class Name</th>
        <th>Grade Count</th>
        <th>Average Grade</th>
        </tr>
        <tr>
    <td>English</td>
    <td>{$count['English']}</td>
    <td>{$avg['English']}</td>
</tr>
<tr>
    <td>Programming</td>
    <td>{$count['Programming']}</td>
    <td>{$avg['Programming']}</td>
</tr>
<tr>
    <td>Math</td>
    <td>{$count['Math']}</td>
    <td>{$avg['Math']}</td>
</tr></table></div>";
        ;
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
    public function createGrade($data)
    {
        if (!isset($data['grade']) || !isset($data['student_name']) || !isset($data['class_name'])) {
            header('Location: ../error.php?message=' . urlencode("Some fields are missing"));
            return;
        }
        $studentContr = new StudentController($this->pdo);
        $student = $studentContr->getStudentByNameAndGroup($this->pdo, $data["student_name"], $data["group_name"]);
        if ($student == null) {
            header('Location: ../error.php?message=' . urlencode("Student '" . $data["student_name"] . "' not found in group '" . $data["group_name"] . "'"));
            return;
        }
        // TODO: Check comment for innaproppriate words and long size
        $stmt = $this->pdo->prepare("INSERT INTO grades (grade, comment, student_name, class_name) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$data['grade'], $data['comment'], $data['student_name'], $data['class_name']])) {
            header('Location: ../feedback.php?student_name=' . urlencode($data['student_name']) . '&group_name=' . urlencode($data['group_name']) . '&class_name=' . urlencode($data['class_name']) . '&grade=' . urlencode($data['grade']));
            //echo json_encode(["message" => "Grade created successfully"]);
        } else {
            echo json_encode(["message" => "Failed to create grade"]);
        }
    }

    // Function to update grade by ID
    public function updateGrade($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['grade']) && isset($data['student_name']) && isset($data['class_name'])) {
            $stmt = $this->pdo->prepare("UPDATE grades SET grade = ?, comment = ?, student_name = ?, class_name = ? WHERE id = ?");
            if ($stmt->execute([$data['grade'], $data['comment'], $data['student_name'], $data['class_name'], $id])) {
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


