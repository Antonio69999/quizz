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

    <div class="container justify-content-evenly fixed-bottom">
        <div class="button-wrapper">
            <?php
            $answers = array($question['rep_true'], $question['wrong1'], $question['wrong2'], $question['wrong3']);
            shuffle($answers);

            $buttonClasses = array('btn-danger btn-red', 'btn-warning btn-yellow', 'btn-primary btn-blue', 'btn-success btn-green');
            shuffle($buttonClasses);

            for ($i = 0; $i < count($answers); $i++) {
                echo '<button class="btn btn-lg ' . $buttonClasses[$i] . '">' . $answers[$i] . '</button>';
            }
            ?>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>