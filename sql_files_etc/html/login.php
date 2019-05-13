<?php
    session_start();
    $dbhost = '127.0.0.1';
    $dbuser = 'pdey3';
    $dbpass = 'cs411';
    $dbport = 3036;
    $db = 'wine_snob';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = mysql_real_escape_string ($_POST['username']);
	$pswd = mysql_real_escape_string($_POST['password']);

	$verify_username = "SELECT count(*) as s_chk FROM USERS WHERE user_id='$username'";
        $result = mysqli_query($conn, $verify_username);
	$count = mysqli_fetch_assoc($result);


	if ($count['s_chk'] == 0) {
	    echo "Sorry but this username doesn't exist.";
	} else {
	   $verify_pswd = "SELECT password as pswd2 FROM USERS WHERE user_id='$username'";
	   $result = mysqli_query($conn, $verify_pswd);
	   $actual_pswd = mysqli_fetch_assoc($result);

	   if (strcmp($pswd, $actual_pswd['pswd2']) == 0) {
		echo "Logged in!";
		$_SESSION['logged_in'] = true;
   		$_SESSION['user_name'] = $username;
		echo $_SESSION['logged_in'];
	header("Location: http://sp19-cs411-48.cs.illinois.edu/index.php");
        die();
	   }
	   else {
		echo "Looks like you entered the wrong password!";
	}}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

<h2>Login Page</h2>
	<!-- this is a post method because we need data from the client side: they are entering the username and password -->
      <form method = "post" action = "login.php">
         <table>
            <tr>
               <td>Username:</td>
               <td><input type="text" name="username"></td>
            </tr>
            <tr>
               <td>Password Again:</td>
               <td><input type="password" name="password"></td>
            </tr>
	    <tr>
		<td><input type="submit" name="login_btn" value="Login">
	    </tr>
         </table>
      </form>
</body>
</html>
