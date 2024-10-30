<?php
include ("session_check.php"); 
include("top.php"); 
?>
<style>
    .match img {
        height: 100px; 
        object-fit: cover;
    }
</style>
<h1>Matches for <?= $_GET["name"] ?></h1>
<div class='match'>
    <?php printMatchesFromFile(); ?>
</div>

<?php include("bottom.php"); ?>

<?php

function printMatchesFromFile()
{
    $loginUser = "";
    foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $loginUser) {
        if ($_GET["name"] == explode(",", $loginUser)[0]) {
            break;
        }
    }

    foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $matchUser) {
        $matchUserData = explode(",", $matchUser);

        if (
            $matchUserData[0] != explode(",", $loginUser)[0]
            && $matchUserData[1] != explode(",", $loginUser)[1]
            && $matchUserData[2] >= explode(",", $loginUser)[5]
            && $matchUserData[2] <= explode(",", $loginUser)[6]
            && $matchUserData[4] == explode(",", $loginUser)[4]
            && (
                str_contains($matchUserData[3], str_split(explode(",", $loginUser)[3])[0])
                || str_contains($matchUserData[3], str_split(explode(",", $loginUser)[3])[1])
                || str_contains($matchUserData[3], str_split(explode(",", $loginUser)[3])[2])
                || str_contains($matchUserData[3], str_split(explode(",", $loginUser)[3])[3])
            )
        ) {
            $userImage = isset($matchUserData[7]) ? $matchUserData[7] : 'images/user.jpg';
            ?>
            <p><img src='<?= htmlspecialchars($userImage) ?>' alt='user icon' class='user-icon'><?= htmlspecialchars($matchUserData[0]) ?></p>
            <ul>
                <li><strong>gender:</strong> <?= htmlspecialchars($matchUserData[1]) ?></li>
                <li><strong>age:</strong> <?= htmlspecialchars($matchUserData[2]) ?></li>
                <li><strong>type:</strong> <?= htmlspecialchars($matchUserData[3]) ?></li>
                <li><strong>OS:</strong> <?= htmlspecialchars($matchUserData[4]) ?></li>
            </ul>
        <?php }
    }
}

?>
