<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body class="d-flex flex-column align-items-center pt-5">
<?php
use Api\Controllers\GradeController;
include_once __DIR__.'/Api/Controllers/GradeController.php';

$gradeController = new GradeController($pdo);

// Fetch all grades as an array
$allGrades = $gradeController->allGrades();
var_dump($allGrades); // Check what allGrades() returns

if (empty($allGrades)) {
    die("No grades data found.");
}

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

foreach ($allGrades as $grade) {
    var_dump($grade); // Check the structure of each grade
    if (isset($grade['class_name']) && isset($grade['grade'])) {
        if(isset($avg[$grade['class_name']])){
            $avg[$grade['class_name']] += $grade['grade'];
            $count[$grade['class_name']]++;
        }
    } else {
        echo "Invalid grade structure: ";
        var_dump($grade); // Show the problematic structure
    }
}

foreach($avg as $class=>$totalGrade)
{
    if($count[$class] > 0){
        $avg[$class] = $totalGrade / $count[$class];
    }
}

var_dump($avg); // Debugging output
var_dump($count); // Debugging output

echo "<tr>
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
</tr>";
?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>