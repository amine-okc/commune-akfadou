<?php
 include("../dbconn.php");

 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 }
$user = $_GET['user'];
if ($user != $_SESSION['id'])
{
    echo "<script>alert('Erreur !'); location.href = '/admin/index.php'</script>";
}

$truncatetable = mysqli_query($connection,"DELETE FROM contact where admin = {$user}");

if($truncatetable !== FALSE)
{
   echo "<script>alert('Supprimé !'); location.href = '/admin/index.php';</script>";
}
else
{
    echo "<script>alert('Erreur !'); location.href = '/admin/index.php';</script>";
}

?>