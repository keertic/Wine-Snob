<?php
    session_start();
    $dbhost = '127.0.0.1';
    $dbuser = 'pdey3';
    $dbpass = 'cs411';
    $dbport = 3036;
    $db = 'wine_snob';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = mysql_real_escape_string($_POST['name']);
	$username = mysql_real_escape_string ($_POST['username']);
	$pswd = mysql_real_escape_string($_POST['password']);
	$age = $_POST['age'];

	$safety_chk = "SELECT count(*) as s_chk FROM USERS WHERE user_id='$username'";
        $result = mysqli_query($conn, $safety_chk);
	$count = mysqli_fetch_assoc($result);

	if ($count['s_chk'] > 0) {
	    echo "Sorry but this username is already taken.";
	} else {
	    // create the user
	   $query = "INSERT INTO USERS(user_id, password, name, age) VALUES('$username', '$pswd', '$name', '$age')";
           mysqli_query($conn, $query);
	   echo "Success!";
	   $_SESSION['logged_in'] = true;
	   $_SESSION['user_name'] = $username;
       header("Location: http://sp19-cs411-48.cs.illinois.edu/index.php");
       die();
	}
      }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register, login, and logout user php mysql</title>
</head>
<body>

<h2>Wine Snob Registration Page</h2>
	<!-- this is a post method because we need data from the client side: they are entering the username and password -->
      <form method = "post" action = "register.php">
         <table>
            <tr>
               <td>Username:</td>
               <td><input type="text" name="username"></td>
            </tr>

            <tr>
               <td>Password:</td>
               <td><input type="password" name ="password"></td>
            </tr>

            <tr>
               <td>Age:</td>
               <td><input type="number" name="age"></td>
            </tr>
            <tr>
               <td>Name:</td>
               <td><input type="text" name="name"></td>
            </tr>

            <tr>
               <td>
                  <input type="submit" name="register_btn" value="Register">
               </td>
            </tr>
         </table>
      </form>


</body>
</html>
