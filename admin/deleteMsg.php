<?php
    session_start();
    if (!isset($_SESSION['AdminLoginId']))
    {
        header("location: index.php");
    }
    else{
        include("../dbconn.php");
        $user = $_SESSION['id'];
        

        $id = $_GET['id']; // get id through query string
        $req = mysqli_query($connection, "select admin from contact where id = '$id'");
        $userMsg = mysqli_fetch_array($req)[0];
        if ($userMsg != $user)
        {
            echo "<script>alert('Erreur !'); location.href = '/admin/index.php';</script>";
        }
        else{
        $del = mysqli_query($connection,"delete from `contact` where id = '$id'"); // delete query

        if($del)
        {
            mysqli_close($connection); // Close connection
            echo "<script>alert('Message supprimé !'); location.href = '/admin/index.php';</script>";
        }
        else
        {
            echo "Error deleting record"; // display error message if not delete
        }
    }
    }
?>