<?php
include 'dbh.php';
session_start();

echo "Your recommendations based on your current reviews are: <br>";

$var = $_SESSION['user_name'];
$checkIfRanOnceSQL = "SELECT rec_ran FROM USERS where user_id='".$var."'";
$checkResult = mysqli_query($conn, $checkIfRanOnceSQL);
$row = mysqli_fetch_row($checkResult);
if ($row[0] === NULL) { // rec_ran variable in each user
        $output = shell_exec("python3.6 recommendation_engine.py '$var'");
        $lines = explode("\n", $output);
        foreach($lines as $wine_id) {
            // $result = mysqli_query($conn, $sql);
            $insertSQL = "INSERT INTO RECOMMENDATIONS (user_id, wine_id) 
                          VALUES ('".$var."',".$wine_id.")";
            $insertResult = mysqli_query($conn, $insertSQL);
       }
        // we need to modify row[0] to True (rec engine has run once)
        $updateSQL = "UPDATE USERS
                      SET rec_ran='True'
                      WHERE user_id='".$var."'";
        $updateResult = mysqli_query($conn, $updateSQL);
} else { // rec_ran is True 
    // 1. Check whether the check_var = TRUE (which means we need to execute)
            // if check_var == false // then just take the values from rec table (bc rev_count%10 != 0)
    $check_varSQL = "SELECT check_var 
                    FROM USERS 
                    WHERE user_id='".$var."'";
    $check_varResult = mysqli_query($conn, $check_varSQL);
    $chkVar = mysqli_fetch_row($check_varResult);
    if ($chkVar[0] == 'True') {
        echo ("checkvar if statement");
        // 2. First delete all the records in the recommendations table for the current user
        $deleteSQL = "DELETE FROM RECOMMENDATIONS WHERE user_id='".$var."'";
        $deleteResult = mysqli_query($conn, $deleteSQL);
        // 3. Execute the python script 
        $command = "python3.6 recommendation_engine.py '$var'";
        echo ($command);
        $output = shell_exec("python3.6 recommendation_engine.py '$var'");
        echo ($output);
        // 4. Insert results into the recommendations table
        $lines = explode("\n", $output);
        echo ("does it reach here?? <br>");
        foreach($lines as $wine_id) {
            // $result = mysqli_query($conn, $sql);
            $insertSQL = "INSERT INTO RECOMMENDATIONS (user_id, wine_id) 
                          VALUES ('".$var."',".$wine_id.")";
            echo ($insertSQL);
            echo ("<br>");
            $insertResult = mysqli_query($conn, $insertSQL);
       }
        // 5. Make the check_var variable to Null
        $updateChkVarSQL = "UPDATE USERS
                            SET check_var=NULL
                            WHERE user_id='".$var."'";
        echo ($updateChkVarSQL);
        $updateChkVarResult = mysqli_query($conn, $updateChkVarSQL); 
    }
}
// Take everything from the recommendations table
$recSQL = "SELECT title FROM RECOMMENDATIONS r, WINES w WHERE r.user_id='".$var."' AND r.wine_id = w.wine_id";
$recResult = mysqli_query($conn, $recSQL);
foreach($recResult as $r) {
            echo("result: ");
            echo($r[title]);
            echo ("<br>");
}
?>
