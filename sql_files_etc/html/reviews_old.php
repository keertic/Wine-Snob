<?php
    session_start();
    $dbhost = '127.0.0.1';
    $dbuser = 'pdey3';
    $dbpass = 'cs411';
    $dbport = 3036;
    $db = 'wine_snob';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    if (isset($_SESSION['logged_in']) && isset($_SESSION['user_name'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $score = $_POST['score'];
              $desc = $_POST['description'];
              $wine_id = $_GET['id'];
              $u_name = $_SESSION['user_name'];

              if ((isset($_POST['score'])) && ($_POST['score'] != '')) {
                  $enter_review_SQL = "INSERT INTO REVIEWS (description, score, user_id, wine_id)
                                       VALUES ('$desc', '$score', '$u_name', '$wine_id')";
                  mysqli_query($conn, $enter_review_SQL);
              } else {
                  echo "You must enter a value for the score!";
                  echo "<br>";
              }
          }
    } else {
        echo "you need to log in first.";
        echo "<br>";
    }

?>

<!DOCTYPE html>
<html>
<head>
        <title>Reviews</title>
</head>
<body>

<h2>Reviews Page</h2>
        <!-- this is a post method because we need data from the client side: they are entering the username and password -->
      <form method = "post" action = "">
         <table>
            <tr>
               <td>Score:</td>
               <td><input type="number" step="1" min="0" max="100" name="score"></td>
            </tr>
            <tr>
               <td>Description:</td>
               <td><input type="text" name="description"></td>
            </tr>
            <tr>
                <td><input type="submit" name="review" value="Submit">
            </tr>
         </table>
      </form>
</body>
</html>
