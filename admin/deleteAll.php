<?php
 include("../dbconn.php");

 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 }
 $id = $_SESSION['id'];
$su = mysqli_fetch_array(mysqli_query($connection, "SELECT su from admins where id = '$id'"))[0];
$table = $_GET['table'];
if (isset($_GET['stat']))
 $stat = $_GET['stat'];
if ($su == "1"){
    if ($table == "projects")
    {
        $res = mysqli_query($connection, "select img from {$table} where stat = '$stat'");
    }
    else if ($table == "appels")
        $res = mysqli_query($connection, "select file from {$table}");
    else
        $res = mysqli_query($connection, "select img from {$table}");
    while ($row = mysqli_fetch_array($res))
    {
        if (isset($row['img']))
            $img = $row['img'];
        else 
            $img = '';
        if ($img != '')
            unlink("../assets/". $table. "/".$img);
    }
    if ($table != "projects")
        $truncatetable = mysqli_query($connection,"TRUNCATE TABLE {$table}");
    else 
    {
        $truncatetable = mysqli_query($connection,"delete from {$table} where stat = '$stat'");
    }
}else{
    if ($table != "projects")
        $res = mysqli_query($connection, "select img from {$table} where author = '$id'");
    else 
        $res = mysqli_query($connection, "select img from {$table} where author = '$id' and stat = '$stat'");
    while ($row = mysqli_fetch_array($res))
    {
        $img = $row['img'];
        if ($img != '')
            unlink("../assets/". $table. "/".$img);
    }
    if ($table != "projects")
        $truncatetable = mysqli_query($connection,"delete from {$table} where author = '$id'");
    else 
        $truncatetable = mysqli_query($connection,"delete from {$table} where author = '$id' and stat = '$stat'"); 
}

if($truncatetable !== FALSE)
{
   echo "<script>alert('Supprimé !'); location.href = '/admin/index.php';</script>";
}
else
{
    echo "<script>alert('Erreur !'); location.href = '/admin/index.php';</script>";
}

?>
