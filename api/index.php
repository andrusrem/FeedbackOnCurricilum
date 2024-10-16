<?php

use Api\Controllers\GradeController;
// Include database connection and controller
include_once __DIR__ .'/config.php';
include_once __DIR__.'/Controllers/GradeController.php';

// Set the headers for CORS and content type
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Instantiate the controller with the database connection
$gradeController = new GradeController($pdo);
// Get the HTTP method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Get the path and split it into array
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));

// Example API: /api/grades or /api/grades/{id}
// Determine which method to call based on the request
switch ($method) {
    case 'GET':
        if (isset($request[1])) {
            $gradeController->getGradeById($request[1]);
        } else {
            $gradeController->allGrades();
        }
        break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!$data) {
                $data = $_POST;
            }
        
            $gradeController->createGrade($data);
            break;
        case 'PUT':
            if (isset($request[1])) {
                $gradeController->updateGrade($request[1]);
            }
            break;
    case 'DELETE':
        if (isset($request[1])) {
            $gradeController->deleteGrade($request[1]);
        }
        break;
    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>