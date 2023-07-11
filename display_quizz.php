<?php session_start(); #on démarre une session pour stocker et recuperer les données à travers pls pages 
if (!isset($_SESSION['displayed-questions'])) {
    $_SESSION['display_questions'] = array(); #stock id_question qui sont affichés
}
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
                                shuffle($questions);

                                foreach ($questions as $question) {
                                    echo ("Question : " . ' ' . $question['question']);
                                }
                                ?>
        </h1>
    </div>

    <form action="./process/right_traitement.php">
    <div class="container justify-content-evenly fixed-bottom">
        <div class="button-wrapper">
            <?php   #stock les reponses aux questions dans une variable
            $answers = array($question['rep_true'], 
            $question['wrong1'], 
            $question['wrong2'], 
            $question['wrong3']); 

            shuffle($answers); #'mélange' les réponse

            #stock les classes des boutons dans une variable et les mélane
            $buttonClasses = array('btn-danger btn-red', 'btn-warning btn-yellow', 'btn-primary btn-blue', 'btn-success btn-green');
            shuffle($buttonClasses);

            # permet d'afficher chaques boutons et leur réponses mélangées
            for ($i = 0; $i < count($answers); $i++) {
                echo '<button type="submit" class="btn btn-lg ' . $buttonClasses[$i] . '">' . $answers[$i] . '</button>';
            }
            ?>
        </div>
    </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>