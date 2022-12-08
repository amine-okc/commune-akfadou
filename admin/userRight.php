<?php
include("../dbconn.php");

session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: index.php");
} 
else {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if ($_POST['superUserChange'] == '0')
            $su = 0;
        else 
            $su = 1;
        
    }
    $user = $_POST['userSU'];
    $sql = "UPDATE admins SET su = '$su' where id = '$user'";
    if ($connection->query($sql) === TRUE) {
        echo '<script type="text/JavaScript"> alert("Droits utilisateur modifiés !")  </script>';
        echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",50);</script>";
    } else {
        echo $connection->error;
        echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",4000);</script>";
        $connection->close();
    }
}

?>