<?php
require_once('./utils/connexion.php');

$request = $db->prepare('SELECT * FROM questions ORDER BY RAND() LIMIT 0,2');
$request->execute();
$questions = $request->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/quizz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>QUIZZ</title>
</head>

<body>
    <div class="d-flex justify-content-center text-jusitfy">
        <h1 class="text-center"><?php
                                require_once('./utils/connexion.php');

                                $request = $db->prepare('SELECT * FROM questions ORDER BY RAND() LIMIT 1');
                                $request->execute();
                                $questions = $request->fetchAll();

                                foreach ($questions as $question) {
                                    echo ("Question : " . ' ' . $question['question']);
                                }
                                ?>
        </h1>
    </div>

    <div class="container">

        <div class="col-6">
            <button class="btn btn-danger btn-lg">Click Me!</button>
        </div>
        <div>
            <button class="btn btn-warning btn-lg">Click Me!</button>
        </div>
        <div class="col-6 position-absolute bottom-0 end-0">
            <button class="btn btn-primary btn-lg">Click Me!</button>
        </div>
        <div class="position-absolute bottom-0 start-0">
            <button class="btn btn-success btn-lg">Click Me!</button>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>