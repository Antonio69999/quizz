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
    <link href="assets/main.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>QUIZZ</title>
</head>

<body>
    <div class="d-flex justify-content-center text-jusitfy">
        <h1 class="text-center"><?php
                                require_once('./utils/connexion.php');

                                $request = $db->prepare('SELECT * FROM questions ORDER BY RAND() LIMIT 1');
                                $request->execute();
                                $question = $request->fetch();
                                echo "Question : " . ' ' . $question['question'];
                                $keyOfQuestion = array_keys($question);
                                // var_dump($temp);
                                ?>
        </h1>
    </div>

    <form action="./process/right_traitement.php" method="post" id="form">
        <div class="container justify-content-evenly fixed-bottom">
            <div class="button-wrapper">
                <?php   #stock les reponses aux questions dans une variable

                $answers = [
                    $keyOfQuestion[4] => $question['rep_true'],
                    $keyOfQuestion[10] => $question['wrong1'],
                    $keyOfQuestion[8] => $question['wrong2'],
                    $keyOfQuestion[6] => $question['wrong3']
                ];

                function shuffle_assoc($answers)
                {
                    $keys = array_keys($answers);

                    shuffle($keys);

                    foreach ($keys as $key) {
                        $new[$key] = $answers[$key];
                    }

                    $answers = $new;

                    return $answers;
                }



                $answers = shuffle_assoc($answers); #'mélange' les réponse

                #stock les classes des boutons dans une variable et les mélane
                $buttonClasses = array('btn-danger btn-red', 'btn-warning btn-yellow', 'btn-primary btn-blue', 'btn-success btn-green');
                shuffle($buttonClasses);

                # permet d'afficher chaques boutons et leur réponses mélangées
                foreach ($answers as $key => $answer) {
                    $numberRand = rand(0, sizeof($buttonClasses) - 1);

                    if ($key === 'rep_true') { ?>
                        <input type="submit" class="btn btn-lg <?php echo $buttonClasses[$numberRand]; ?>" name="correct" value="<?php echo $answer; ?>">
                    <?php } else { ?>
                        <input type="submit" class="btn btn-lg <?php echo $buttonClasses[$numberRand]; ?>" name="wrong" value="<?php echo $answer; ?>">
                    <?php  } ?>




                <?php
                    array_splice($buttonClasses, $numberRand, 1);
                }
                ?>
                <input type="hidden" name="idQuestion" value="<?php echo $question['id_questions'] ?>">
            </div>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>