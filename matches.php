<?php
include ("session_check.php"); 
include("top.php"); 
?>
<form action="matches-submit.php" method="get">

    <fieldset>
        <legend>Returning User:</legend>

        <ul>
            <li>
                <strong>Name:</strong>
                <input type="text" name="name" size="16"/>
            </li>
        </ul>
        <input type="submit" value="View My Matches"/>
    </fieldset>
</form>

<?php include("bottom.php"); ?>