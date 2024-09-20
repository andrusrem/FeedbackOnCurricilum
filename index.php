<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="bg-light">
    <h1 class="fw-lighter text-center m-3" style="letter-spacing: .5rem">FEEDBACK FORM</h1>
    <form action="api/index.php" method="POST">
        <div class="container-sm w-25 d-flex flex-column">
            <div class="mb-3 fs-4 fw-light">
                <label for="group_name" class="form-label">Group</label>
                <input type="text" class="form-control" id="Group" name="group_name" placeholder="Your group">
            </div>
            <div class="mb-5 fs-4 fw-light">
                <label for="student_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="Name" name="student_name" placeholder="Your name">
            </div>
            <div class="mb-4">
                <select class="form-select form-select-lg mb-3 fw-light fs-6" id="Class" name="class_name"
                    aria-label="Large select example">
                    <option selected>Choose class for feedback</option>
                    <option value="English">English</option>
                    <option value="Math">Math</option>
                    <option value="Programming">Programming</option>
                </select>
            </div>
            
            <div class="container mb-5 text-center">
                <h3 class="fw-lighter" style="letter-spacing:.1rem;" >Satisfaction with this course</h3>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="grade" id="inlineRadio1"
                        value="1">
                    <label class="form-check-label" for="grade">1</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="grade" id="inlineRadio2"
                        value="2">
                    <label class="form-check-label" for="grade">2</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="grade" id="inlineRadio3"
                        value="3">
                    <label class="form-check-label" for="grade">3</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="grade" id="inlineRadio4"
                        value="4">
                    <label class="form-check-label" for="grade">4</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="grade" id="inlineRadio5"
                        value="5">
                    <label class="form-check-label" for="grade">5</label>
                </div>
            </div>


            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" name="comment" id="floatingTextarea2"
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2">Explane your answer</label>
            </div>

            <button type="submit" class="btn btn-primary m-auto w-50 fs-6" style="letter-spacing:0.1rem">Submit</button>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>