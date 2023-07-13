<?php session_start(); ?>
<?php require_once('../utils/connexion.php'); ?>

<?php

if (!empty($_POST['correct']) || !empty($_POST['wrong'])) {

    if (!empty($_POST['idQuestion'])) {
        $query = 'SELECT * FROM questions WHERE id_questions = :idQuestion';
        $request = $db->prepare($query);
        $request->execute([
            ':idQuestion' => $_POST['idQuestion'],
        ]);
        $question = $request->fetch();
    }


    if (isset($_POST['correct'])) {
        $id_users = $_SESSION['user']['id_user'];

        $sql = "INSERT INTO `user_answers` (`user_answer`, `id_questions`, `id_user`) VALUES (:correct, :idQuestion, :id_user)";
        $query = $db->prepare($sql);
        $query->execute([
            ':correct' => $_POST['correct'],
            ':idQuestion' => $_POST['idQuestion'],
            ':id_user' => $id_users
        ]);

        $insertedId = $db->lastInsertId();

        if (isset($_POST['correct'])) {
            $_SESSION['score'] = isset($_SESSION['score']) ? $_SESSION['score'] + 1 : 1;
        }
        
        // if (isset($_POST['wrong'])) {
        //     $_SESSION['score'] = isset($_SESSION['score']) ? $_SESSION['score'] - 1 : -1;
        // }

        header('Location: ../quizz_alt.php?idQuestion=' . $_POST['idQuestion']);
        
} else {
        $id_users = $_SESSION['user']['id_user'];

        $sql = "INSERT INTO `user_answers` (`user_answer`, `id_questions`, `id_user`) VALUES (:wrong, :idQuestion, :id_user)";
        $query = $db->prepare($sql);
        $query->execute([
            ':wrong' => $_POST['wrong'],
            ':idQuestion' => $_POST['idQuestion'],
            ':id_user' => $id_users
        ]);

        if (isset($_POST['correct'])) {
            $_SESSION['score'] = isset($_SESSION['score']) ? $_SESSION['score'] + 1 : 1;
        }
        
        // if (isset($_POST['wrong'])) {
        //     $_SESSION['score'] = isset($_SESSION['score']) ? $_SESSION['score'] - 1 : -1;
        // }

        $insertedId = $db->lastInsertId();
        header('Location: ../quizz_alt.php?idQuestion=' . $_POST['idQuestion']);   

    }
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

$sql = "INSERT INTO `score` (`score`, `id_user`) VALUES (:score, :id_user)";
$query = $db->prepare($sql);
$query->bindValue(':score', $score, PDO::PARAM_INT);
$query->bindValue(':id_user', $_SESSION['user']['id_user'], PDO::PARAM_INT);
$query->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/answers.css">
    <title>Answers</title>
</head>

<body>
</body>

</html>