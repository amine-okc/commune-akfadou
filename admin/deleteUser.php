<?php
 include("../dbconn.php");
 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 }else{

$user = $_GET['user'];
$dir = "../assets/admins/";
$query = "SELECT img FROM `admins` where id = '$user'";
$result1 = mysqli_query($connection, $query);
$img = '';
$row = mysqli_fetch_array($result1)[0];
if(isset($row['img']))
    $img = $row['img'];
$msgs = "DELETE from `contact` where admin = '$user' ";
$delete = "DELETE from `admins` where id = '$user'";
$result2 = mysqli_query($connection, $msgs);
$result3 = mysqli_query($connection, $delete);
if ($result2 && $result3) {
    if ($img != '' && !unlink($dir . $img)) {
        echo '<script type="text/JavaScript"> alert("Erreur !")  </script>';
        die();
    } else {
        echo '<script type="text/JavaScript"> alert("Utilisateur supprimé !")  </script>';
        if ($user == $_SESSION['id']) {
            session_destroy();
            header("location: index.php");
        }
    }
    echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",50);</script>";
}
 }
