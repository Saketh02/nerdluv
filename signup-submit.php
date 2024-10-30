<?php
include("session_check.php"); 
include("top.php"); 
?>
<div>
    <?php
    function validateInput()
    {
        $errors = [];
        if (empty($_POST["name"])) {
            $errors[] = "Name must not be blank.";
        }
        $filePath = "singles.txt";
        if (file_exists($filePath)) {
            $file = fopen($filePath, "r");
            while (($line = fgets($file)) !== false) {
                $data = explode(",", trim($line));
                if (isset($data[0]) && $data[0] === $_POST["name"]) {
                    $errors[] = "Name already exists. Please choose a different name.";
                    break;
                }
            }
            fclose($file);
        }
        if (!isset($_POST["age"]) || !preg_match("/^[0-9]{1,2}$/", $_POST["age"]) || (int)$_POST["age"] < 0 || (int)$_POST["age"] > 99) {
            $errors[] = "Age must be a number between 0 and 99.";
        }
        if (!isset($_POST["gender"]) || !in_array($_POST["gender"], ["M", "F"])) {
            $errors[] = "Gender must be 'M' (Male) or 'F' (Female).";
        }
        if (!isset($_POST["type"]) || !preg_match("/^[IE][NS][FT][JP]$/", $_POST["type"])) {
            $errors[] = "Personality type must be a valid 4-letter Keirsey type.";
        }
        $allowed_os = ["Windows", "Mac OS X", "Linux"];
        if (!isset($_POST["OS"]) || !in_array($_POST["OS"], $allowed_os)) {
            $errors[] = "Favorite OS must be one of the provided choices.";
        }
        if (!isset($_POST["min"]) || !preg_match("/^[0-9]{1,2}$/", $_POST["min"]) || (int)$_POST["min"] < 0 || (int)$_POST["min"] > 99) {
            $errors[] = "Minimum seeking age must be between 0 and 99.";
        }
        if (!isset($_POST["max"]) || !preg_match("/^[0-9]{1,2}$/", $_POST["max"]) || (int)$_POST["max"] < 0 || (int)$_POST["max"] > 99) {
            $errors[] = "Maximum seeking age must be between 0 and 99.";
        }
        if (isset($_POST["min"], $_POST["max"]) && (int)$_POST["min"] > (int)$_POST["max"]) {
            $errors[] = "Minimum seeking age must be less than or equal to maximum seeking age.";
        }
        if (!isset($_FILES["profile_picture"]) || $_FILES["profile_picture"]["error"] !== UPLOAD_ERR_OK) {
            $errors[] = "Profile picture upload failed.";
        } elseif (!in_array(mime_content_type($_FILES["profile_picture"]["tmp_name"]), ["image/jpeg", "image/png", "image/gif", "image/webp"])) {
            $errors[] = "Profile picture must be a valid image (JPEG, PNG, GIF, JPG, WEBP).";
        }

        return $errors;
    }

    $errors = validateInput();
    if (!empty($errors)) {
        echo "<h1>Error! Invalid Data</h1>
        <p>We're Sorry. You submitted Invalid Information. Please go back and try again</p><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    } else {
        $imagePath = saveImage();
        ?>
        <h1>Thank you!</h1>
        <p>
            Welcome to NerdLuv, <?= htmlspecialchars($_POST["name"]) ?>!<br/><br/>
            Now <a href="matches.php">log in to see your matches!</a>
        </p>
        <?php
        writeToFile($imagePath);
    }
    ?>
</div>

<?php
function saveImage()
{
    $targetDir = "images/";
    $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $targetFile = $targetDir . basename($_POST["name"]) . "." . $imageFileType;

    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
        return $targetFile;
    }
    return null;
}

function writeToFile($imagePath)
{
    $userInfo = "";
    foreach ($_POST as $key => $attribute) {
        $userInfo .= htmlspecialchars($attribute) . ",";
    }
    $userInfo .= htmlspecialchars($imagePath);
    file_put_contents("singles.txt", "\n" . $userInfo, FILE_APPEND);
}

include("bottom.php");
?>
