<?php
include ("session_check.php"); 
include("top.php"); 
?>
<style>
.logout img {
    height: 25px;
    width: 25px;
}
</style>
<div>
    <h1>Welcome!</h1>
    <ul>
        <li>
            <a href="signup.php">
                <img src="images/signup.gif" alt="icon"/>
                Sign up for a new account
            </a>
        </li>

        <li>
            <a href="matches.php">
                <img src="images/heartbig.gif" alt="icon"/>
                Check your matches
            </a>
        </li>
        <li>
            <a href="logout.php" class="logout">
                <img src="images/logout.png" alt="icon"/>
                Logout
            </a>
        </li>
    </ul>
</div>

<?php include("bottom.php"); ?>
