<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.scss">
</head>
<body>

    <form action="feedback.php" method="GET">
        <div class="container container-max-widths">
        <div class="mb-3">
            <label for="Group" class="form-label">Group</label>
            <input type="text" class="form-control" id="Group" name="Group" placeholder="Your group">
        </div>
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" id="Name" name="Name" placeholder="Your name">
        </div>
        <div class="mb-3">
            <select class="form-select form-select-lg mb-3" id="Class" name="Class" aria-label="Large select example">
                <option selected>Open this select menu</option>
                <option value="English">English</option>
                <option value="Math">Math</option>
                <option value="Programming">Programming</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary ">Submit</button>
        </div>
        
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>