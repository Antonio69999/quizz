<?php session_start(); ?>
<?php require_once('../utils/connexion.php'); ?>


<?php

if (isset($_POST['pseudos']) && !empty($_POST['pseudos'])) {
    $user = $_POST['pseudos'];
    $selectUserQuery = $db->prepare("SELECT * FROM users WHERE pseudos = :pseudos");
    $selectUserQuery->execute([':pseudos' => $user]);
    $user = $selectUserQuery->fetch();
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ../display_quizz.php');
        // le nom d'utilisateur existe déjà
    } else {
        // le nom d'utilisateur n'existe pas
        $insertUserSql = "INSERT INTO users (pseudos) VALUES (:pseudos)";
        $insertUserQuery = $db->prepare($insertUserSql);
        $insertUserQuery->execute([
            ':pseudos' => $_POST['pseudos'],
        ]);
        $userId = $db->lastInsertId();
        $_SESSION['user']['pseudos'] = $_POST['pseudos'];
        $_SESSION['user']['id_user'] = $userId;
        var_dump($_SESSION);
        header('Location: ../display_quizz.php');
    }
}

?>
