<?php var_dump($_POST); ?>


<?php session_start(); ?>
<?php require_once('../utils/connexion.php'); ?>

<?php

if ( !empty($_POST['correct']) || !empty($_POST['wrong'])) {

    if(!empty($_POST['idQuestion'])){
        $query = 'SELECT * FROM questions WHERE id_questions = :idQuestion';
        $request = $db->prepare($query);
        $request->execute([
            ':idQuestion' => $_POST['idQuestion'],
        ]);
        $question = $request->fetch();
    }

    if (isset($_POST['correct'])) {
        echo "Bonne réponse";

    } else {
        echo "Mauvaise réponse";
    }
}

?>