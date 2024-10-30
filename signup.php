<?php
include("session_check.php"); 
include("top.php"); 
?>
<style>
    li {
        margin-bottom: 10px;
    }
</style>
<form action="signup-submit.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>New User Signup:</legend>
        <ul>
            <li>
                <strong>Name:</strong>
                <input type="text" name="name" size="16"/>
            </li>
            <li>
                <strong>Gender:</strong>
                <label><input type="radio" name="gender" value="M"/>Male</label>
                <label><input type="radio" name="gender" value="F"/>Female</label>
            </li>
            <li>
                <strong>Age:</strong>
                <input type="text" name="age" size="6" maxlength="2"/>
            </li>
            <li>
                <strong>Personality type:</strong>
                <input type="text" name="type" size="6" maxlength="4"/>
                <a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">(Don't know your type?)</a>
            </li>
            <li>
                <strong>Favorite OS:</strong>
                <select name="OS">
                    <option selected="selected">Windows</option>
                    <option>Mac OS X</option>
                    <option>Linux</option>
                </select>
            </li>
            <li>
                <strong>Seeking Age:</strong>
                <input type="text" name="min" size="6" maxlength="2" placeholder="min"/> to
                <input type="text" name="max" size="6" maxlength="2" placeholder="max"/>
            </li>
            <li>
                <strong>Profile Picture:</strong>
                <input type="file" name="profile_picture" accept="image/*"/>
            </li>
        </ul>
        <input type="submit" value="Sign Up"/>
    </fieldset>
</form>

<?php include("bottom.php"); ?>
