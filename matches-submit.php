<?php
include("session_check.php");
include("top.php");
?>
<style>
    .match img {
        height: 100px;
        object-fit: cover;
    }
</style>

<h1>Matches for <?= htmlspecialchars($_GET["name"]) ?></h1>
<div class='match'>
    <?php printMatchesFromFile(); ?>
</div>

<?php include("bottom.php"); ?>

<?php

function printMatchesFromFile()
{
    $loginUser = null;
    $name = $_GET["name"];
    
    foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $user) {
        $userData = explode(",", $user);
        if ($userData[0] === $name) {
            $loginUser = $userData;
            break;
        }
    }
    if (!$loginUser) {
        echo "<p>User with the given name doesn't exist.</p>";
        return;
    }

    list($loginName, $loginGender, $loginAge, $loginType, $loginOS, $loginMinAge, $loginMaxAge) = $loginUser;
    
    foreach (file("singles.txt", FILE_IGNORE_NEW_LINES) as $matchUser) {
        $matchUserData = explode(",", $matchUser);
        list($matchName, $matchGender, $matchAge, $matchType, $matchOS) = $matchUserData;


        if (
            $matchName != $loginName &&  
            $matchGender != $loginGender && 
            $matchAge >= $loginMinAge && $matchAge <= $loginMaxAge &&
            $loginAge >= $matchUserData[5] && $loginAge <= $matchUserData[6] &&
            $matchOS == $loginOS &&
            countMatchingPersonalityLetters($loginType, $matchType) >= 1  
        ) {
            $userImage = isset($matchUserData[7]) ? $matchUserData[7] : 'images/user.jpg';
            ?>
            <p><img src='<?= htmlspecialchars($userImage) ?>' alt='user icon' class='user-icon'><?= htmlspecialchars($matchName) ?></p>
            <ul>
                <li><strong>gender:</strong> <?= htmlspecialchars($matchGender) ?></li>
                <li><strong>age:</strong> <?= htmlspecialchars($matchAge) ?></li>
                <li><strong>type:</strong> <?= htmlspecialchars($matchType) ?></li>
                <li><strong>OS:</strong> <?= htmlspecialchars($matchOS) ?></li>
            </ul>
            <?php
        }
    }
}
function countMatchingPersonalityLetters($type1, $type2)
{
    $matches = 0;
    for ($i = 0; $i < min(strlen($type1), strlen($type2)); $i++) {
        if ($type1[$i] === $type2[$i]) {
            $matches++;
        }
    }
    return $matches;
}
?>
