<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="./style.css">
</head>
<body>
<h1 style="text-align: center;">Thank you, <?php echo $_POST["student_name"]; ?>!</h1>
<div class="container-sm border-rounded" style="text-align: center;">
    <p>Your Group is: <?php echo $_POST["group_name"]; ?></p>
   
    <p>You gived <?php echo $_POST["class_name"]; ?> class <?php echo $_POST["grade"]; ?> points</p>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>