<html>

   <head>
      <title>Wine Snob Registration</title>
   </head>

   <body>
      <?php
/*
      $dbhost = '127.0.0.1';
      $dbuser = 'pdey3';
      $dbpass = 'cs411';
      $dbport = 3036;
      $db = 'wine_snob';
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
*/
	if (isset($_POST['register_btn'])) {
		echo "It is set";
}
 /*       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "It is set";
/*
            $name = $_POST['name'];
            $username =  $_POST['username'];
            $password = $_POST['password']);
            $password2 = $_POST['password2']);
            $age = $_POST['age'];

            $query = "INSERT INTO USERS (user_id, name, age) VALUES('$username',  '$name', '$age')";
            mysqli_query($conn, $query);
*/ 
      ?>

      <h2>Wine Snob Registration Page</h2>

      <form method = "post" action = "register.php">
         <table>
            <tr>
               <td>Name:</td>
               <td><input type="text" name="name"></td>
            </tr>

            <tr>
               <td>Username:</td>
               <td><input type = "text" name = "username"></td>
            </tr>

            <tr>
               <td>Password:</td>
               <td><input type = "password" name = "password"></td>
            </tr>

            <tr>
               <td>Password Again:</td>
               <td><input type = "password" name = "password"></td>
            </tr>

            <tr>
               <td>Age:</td>
               <td><input type = "number" name = "age"></td>
            </tr>

            <tr>
               <td>
                  <input type = "submit" name = "register_btn" value = "Register">
               </td>
            </tr>
         </table>
      </form>

      <?php
         echo "<h2>Your Given details are as :</h2>";

         echo $name;
         echo "<br>";

         echo $username;
         echo "<br>";

         echo $password;
         echo "<br>";

         echo $password2;
         echo "<br>";

         echo $age;
      ?>

   </body>
</html>
