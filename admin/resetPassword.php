<?php
    
    include("../dbconn.php");

    session_start();
    if (!isset($_SESSION['AdminLoginId']))
    {
        header("location: index.php");
    }
    $id = $_POST['id'];
    $sql = "SELECT password from admins where id = '$id'";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_array($result))
        if(!password_verify($_POST['oldPass'] ,$row['password']))
    {
        echo "<script>alert('Ancien mot de passe invalide.')</script>";
    }else{
        if ($_POST['newPass'] != $_POST['newPassConf']){
        echo "<script>alert('Les deux mots de passe ne correspondent pas.')</script>";
        }else{
            $newpass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
            $sql = "UPDATE admins SET password = '$newpass' where id = '$id'";
            if ($connection->query($sql) === TRUE)
            {
            echo "<script>alert('Le mot de passe a été modifié !')</script>";
            }else{
            echo "<script>alert('Erreur inconnue')</script>";
            
            }
        }
    }
    echo "<script>setTimeout(\"location.href = 'admin_dash.php';\",40);</script>";
?>