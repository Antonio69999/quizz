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
    <div class="container d-flex justify-content-center text-center">
        <div class="row">
            <div class="my-5">
                <h1 class="text-center"><?php
                                        require_once('./utils/connexion.php');
                                        $request = $db->prepare('SELECT * FROM questions WHERE id_questions= :id_questions');
                                        // $request = $db->prepare('SELECT * FROM questions INNER JOIN user_answers WHERE questions.id_questions = user_answers.id_questions');
                                        $request->execute([
                                            ':id_questions' => $_GET['idQuestion'],
                                        ]);
                                        $question = $request->fetch();
                                        echo "Question : " . ' ' . $question['question'];
                                        $keyOfQuestion = array_keys($question);
                                        // var_dump($temp);
                                        ?>
                </h1>
            </div>

            <div class="container row d-flex justify-content-center">
                <div class="col-12 d-flex justify-content-center mb-4">
                    <h2>LA BONNE REPONSE EST :</h2>
                </div>
                <br>
                <div class="col-12 d-flex justify-content-center my-4">
                    <h3 class="score">Voici votre score actuel :

                        <?php
                        $id_users = $_SESSION['user']['id_user'];
                        $score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

                        $sql = "INSERT INTO `scores` (`score`, `id_user`) VALUES (:score, :id_user)";
                        $query = $db->prepare($sql);
                        $query->execute([
                            ':score' => $score,
                            ':id_user' => $id_users
                        ]);

                        $insertedId = $db->lastInsertId();


                        echo $score;
                        ?>
                    </h3>
                </div>
            </div>


            <div class="container d-flex justify-content-center mt-2">
                <form action="./display_quizz.php" method="post">
                    <input type="submit" class="btn btn-light w-100" name="suivant" value="Question suivante ➜">
                </form>
            </div>

            <form action="./process/alt_traitement.php" method="post">
                <div class="container justify-content-evenly fixed-bottom">
                    <div class="button-wrapper gap-3">
                        <?php   #stock les reponses aux questions dans une variable

                        $answers = [
                            $keyOfQuestion[4] => $question['rep_true'],
                            $keyOfQuestion[10] => $question['wrong1'],
                            $keyOfQuestion[8] => $question['wrong2'],
                            $keyOfQuestion[6] => $question['wrong3']
                        ];


                        #stock les classes des boutons dans une variable
                        $buttonClasses = array('btn-danger btn-red', 'btn-success btn-green');

                        # permet d'afficher chaques boutons et leur réponses mélangées
                        foreach ($answers as $key => $answer) {

                            if ($key === 'rep_true') { ?>
                                <input type="button" class="btn btn-lg <?php echo $buttonClasses[1]; ?>" name="correct" value="<?php echo $answer; ?>">
                            <?php } else { ?>
                                <input type="button" class="btn btn-lg <?php echo $buttonClasses[0]; ?>" name="wrong" value="<?php echo $answer; ?>">
                            <?php  } ?>




                        <?php
                        }
                        ?>
                        <input type="hidden" name="idQuestion" value="<?php echo $question['id_questions'] ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>