<?php session_start(); 
require_once("./utils/connexion.php"); ?>

<?php

$query = 'SELECT id_score, score, id_user FROM scores';
$request = $db->prepare($query);
$request->execute();
$scores = $request->fetchAll();

foreach ($scores as $score) {
    $id_score = $score['id_score'];
    $score_value = $score['score'];
    $id_user = $score['id_user'];
}

$rank = 1;



      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/leaderboard.css">
    <title>Score Leaderboard</title>
</head>
<body>
    <h1>Score Leaderboard</h1>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Score</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($scores as $score) {
                $scoreValue = $score['score'];
                $userId = $score['id_user'];

                $query = 'SELECT pseudos FROM users WHERE id_user = :userId';
                $request = $db->prepare($query);
                $request->bindValue(':userId', $userId);
                $request->execute();
                $user = $request->fetch();

                $pseudo = $user['pseudos'];

                echo "<tr>
                        <td>$rank</td>
                        <td>$scoreValue</td>
                        <td>$pseudo</td>
                    </tr>";
                $rank++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
