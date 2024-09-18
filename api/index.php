<?php


// Include database connection and controller
include_once 'config.php';
include_once '\api\Controllers\GradeController';

// Set the headers for CORS and content type
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Instantiate the controller with the database connection
$gradeController = new GradeController($pdo);
// Get the HTTP method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Get the path and split it into array
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

// Example API: /api/grades or /api/grades/{id}
// Determine which method to call based on the request
switch ($method) {
    case 'GET':
        if (isset($request[1])) {
            $gradeController->getGradeById($request[1]);
        } else {
            $gradeController->getGrades();
        }
        break;
    case 'POST':
        $gradeController->createGrade();
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
