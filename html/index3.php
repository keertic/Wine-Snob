<!DOCTYPE HTML>
<!-- This file holds the layout for the Wine Snob home page! -->

<html>

<head>
	Wine Snob Main Page<br />
</head>

Welcome to our wine snob main page! <br />

For wine info: <a href="http://sp19-cs411-48.cs.illinois.edu/wine_info_2.php">click here</a>

login: <a href="http://sp19-cs411-48.cs.illinois.edu/login.php">login</a>

review: <a href="http://sp19-cs411-48.cs.illinois.edu/reviews.php">review</a>
<form method="post">
    <input type="submit" name="logout" id="logout" value="RUN" /><br/>
</form>
</html>

<?php

function testfun()
{
	echo 'hello';
	echo $_SESSION['user_name'];
	session_start();
	unset($_SESSION['logged_in']);
	unset($_SESSION['user_name']);
	echo $_SESSION['user_name'];  
}
if(array_key_exists('logout',$_POST)){
   testfun();
}

?>

